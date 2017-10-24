<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use app\modules\user\forms\LoginForm;
use app\modules\user\forms\RegForm;
use app\modules\user\forms\ResetPasswordForm;
use app\modules\user\forms\SendEmailForm;
use app\modules\user\models\Email;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use LightOpenID;
use Yii;
use yii\db\Exception;
use yii\helpers\Url;
use function D;

/**
 * Description of AuthoriseController
 *
 * @author Anastasiya
 */
class AuthController extends FrontControlller {
    
    
    public function actionReg() {
        
        //check rquest
        if (Yii::$app->request->isAjax) {
            
            $model = new RegForm();
            
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                
                //create user
                $user = $model->reg();
                
                //if create success
                if ($user) {
                    
                    //find or create new Email for this user
                    $email = ($email = Email::findByUserEmail($user->email)) ? $email : new Email();
                    
                    if($email->createEmail($user, Email::EMAIL_ACTIVATE)) {
                        Yii::$app->session->setFlash('success', 'На ваш email отправлено письмо с подтверждением');
                        return $this->refresh();
                    }
                    
                }
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации попробуйте еще раз.');
            }
            
            return $this->renderPartial(
                            'reg', ['model' => $model]
            );
            
        }
        
        // if not Ajax Request Redirect its happen when we use RBAC and permision denied
        return $this->redirect(['/forecasts/forecast/index']);
        
    }

    public function actionSteamLogin(){
        //Set Steam Api Key
        $steamKey = 'BB5C149531065D6659743AC5734D58EC';
        
        try {
                //First request set your action 
                $openId = new LightOpenID(Url::to(['/user/auth/steam-login'], true));
                
                //first times  openId->mode = null ,it redirect you in steam comunity
                
                if (!$openId->mode) {
                    $openId->identity = 'http://steamcommunity.com/openid';
                    return $this->redirect($openId->authUrl());
                    
                //if login was success in __construct LightOpenID->data was fill fis data from POST
                } elseif ($openId->mode != 'cancel' && $openId->validate()) {
                    
                    //Get user_id From $openId->identity like: [url]http://steamcommunity.com/openid/id/76561197960435530[/url]
                    $matches = [];
                    preg_match('/^http:\/\/steamcommunity\.com\/openid\/id\/(?P<user_id>\w+)/', $openId->identity, $matches);
                    
                    
                    
                    if (isset($matches['user_id'])) {
                        $userData = $this->steamRequest($steamKey, $matches['user_id']);
                        if (isset($userData->response, $userData->response->players, $userData->response->players[0], $userData->response->players[0]->steamid)) {
                            
                            if (($user = User::find()->where(['steam_id' => $userData->response->players[0]->steamid])->one()) === null) {
                                
                                $user = new User([
                                    'username' => $userData->response->players[0]->personaname,
                                    'status' => User::STATUS_NOT_ACTIVE,
                                    'auth_key' => \Yii::$app->security->generateRandomString($length = 32),
                                    'created_at' => time(),
                                    'updated_at' => time(),
                                    'role' => User::ROLE_USER,
                                    'steam_id' => $userData->response->players[0]->steamid,
                                    'avatar_path' => $userData->response->players[0]->avatarfull
                                ]);
                                
                                
                                
                                if (!$user->save()) {
                                    throw new Exception('CREATE STEAM USER failed ' . __FILE__ . ': ' . __METHOD__);
                                }else {
                                    Yii::$app->session->setFlash('success', 'Вы успешно зарегестрировались через Steam.');
                                }
                                
                                
                            }else{
                                $user->avatar_path = $userData->response->players[0]->avatarfull;
                                $user->save();
                            }
                            
                            
                            Yii::$app->user->login($user, 3600 * 24 * 30);
                            
                            return $this->redirect(['/user/user/profile']);
                        }
                        
                    }
                } else {
                    Yii::$app->session->setFlash('error', Yii::t('app', 'User has canceled authentication! 1'));
                }
            } catch (Exception $ex) {
                Yii::$app->session->setFlash('error', Yii::t('app', 'User has canceled authentication! 2'));
            }
    }
    
    
    public function steamRequest($steamKey,$id){
        
        $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$steamKey&steamids=$id";
        $userAgent = 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:54.0) Gecko/20100101 Firefox/54.0';
        
        $ch = curl_init();  //Инициализация сеанса
        if ($ch) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_REFERER, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
            $str = curl_exec($ch);
            curl_close($ch);

            return json_decode($str);
        } else {
            Yii::warning(__METHOD__ . 'steam curl issue', 'steam');
            throw new Exception(__METHOD__);
        }
        
    }
    
    // Подтверждение email
    public function actionActivateEmail($key) {
        $user = User::findByEmailKey($key);
        
        //if find user
        if ($user) {
            
            //change status
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            
            //delete email
            $email = Email::findByUserEmail($user->email);
            if ($email) {
                $email->delete();
            }
            
            //autologin
            if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                Yii::$app->session->setFlash('success', 'Вы успешно подтвердили свой email.');
                return $this->redirect(['/forecasts/forecast/index']);
            }
        }

        return $this->redirect(['/forecasts/forecast/index']);
    }

    
    
    // Создание запроса на востановление пароля 
    public function actionResetPassword() {
        if (Yii::$app->request->isAjax) {
            
            $model = new SendEmailForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmailForResetPassword()) {
                    return $this->redirect(['/forecasts/forecast/index']);
                }
            }
            return $this->renderPartial('reset-password', [
                'model' => $model,
            ]);
        }
        
        return $this->redirect(['/forecasts/forecast/index']);
    }

    // Повторная отправка активационного письма
    
    public function actionSendReactivateEmail() {
        
        if (Yii::$app->request->isAjax) {
            
            $model = new SendEmailForm();
            
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                
                if ($model->sendReactivateEmail()) {
                    return $this->redirect(['/forecasts/forecast/index']);
                }
                
            }
            return $this->renderPartial('send-reactivate-email', [
                        'model' => $model,
            ]);
        }
        
        return $this->redirect(['/forecasts/forecast/index']);
    }
    
    
    public function actionSetnewPassword($key) {
        
        $token = Token::findBySecretKey($key);

        if (!is_null($token) && $token->isSecretKeyExpire()) {

            $model = new ResetPasswordForm();
            
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->resetPassword($token)) {
                    
                    Yii::$app->session->setFlash('success', 'Ваш пароль успешно изменен');
                    
                    $email = Email::findByUserToken($key);
                    if ($email) {
                        $email->delete();
                    }
                    return $this->redirect(['/forecasts/forecast/index']);
                }
            }
            return $this->render('setnew-password', [
                'model' => $model,
            ]);
            
        }else{
            Yii::$app->session->setFlash('error', 'Либо неверно указан ключи или срок ссылки на изменение пароля истек, отправьте новй запрос на востановление пароля');
        }
        
        return $this->redirect(['/forecasts/forecast/index']);
    }

    
    
    public function actionLogin() {
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {
                if ($model->login()) {
                    if ($model->user->role == User::ROLE_ADMIN) {
                        return $this->redirect(['/admin']);
                    } else {
                        return $this->redirect(['/forecasts/forecast/index', 'username' => Yii::$app->user->identity->username]);
                    }
                    return $this->redirect(['/forecasts/forecast/index']);
                } else {
                    return $this->refresh();
                }
            }
            return $this->renderPartial('login', [
                        'model' => $model,
            ]);
        }
        return $this->redirect(['/forecasts/forecast/index']);
    }

    
    
    
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/forecasts/forecast/index']);
    }

    
    


}
