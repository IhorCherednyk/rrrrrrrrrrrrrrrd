<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use app\helpers\ImageHelper;
use app\modules\user\forms\LoginForm;
use app\modules\user\forms\RegForm;
use app\modules\user\forms\ResetPasswordForm;
use app\modules\user\forms\SendEmailForm;
use app\modules\user\models\Email;
use app\modules\user\models\Token;
use app\modules\user\models\User;
use Yii;
use yii\debug\models\search\Profile;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

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
