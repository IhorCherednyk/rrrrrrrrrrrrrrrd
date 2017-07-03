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


    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionReg() {
        if (Yii::$app->request->isAjax) {
            $model = new RegForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $user = $model->reg();
                $model = new RegForm();
                if ($user) {
                    $email = ($email = Email::findByUserEmail($user->email)) ? $email : new Email();
                    $email->createEmail($user, Email::EMAIL_ACTIVATE);
                    Yii::$app->session->setFlash('success', 'На ваш email отправлено письмо с подтверждением');
                    return $this->redirect(['/site/index']);
                }
                Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации попробуйте еще раз.');
                return $this->renderPartial(
                                'reg', ['model' => $model]
                );
            }
            return $this->renderPartial(
                            'reg', ['model' => $model]
            );
        }
        return $this->redirect(['/site/index']);
    }

    public function actionActivateEmail($key) {
        $user = User::findByEmailKey($key);

        if ($user) {
            $user->status = User::STATUS_ACTIVE;
            $user->save();
            $email = Email::findByUserEmail($user->email);
            if ($email) {
                $email->delete();
            }
            if (Yii::$app->getUser()->login($user, 3600 * 24 * 30)) {
                Yii::$app->session->setFlash('success', 'Вы успешно подтвердили свой email.');
                return $this->redirect(['/site/index']);
            }
        }

        return $this->redirect(['site/index']);
    }

    public function actionSendEmail() {
        if (Yii::$app->request->isAjax) {
            $model = new SendEmailForm();

            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->sendEmail()) {
                    Yii::$app->session->setFlash('success', 'На вашу почту выслано подтверждение на изменения пароля');
                    return $this->redirect(['/site/index']);
                }
            }
            return $this->renderPartial('send-email', [
                        'model' => $model,
            ]);
        }
        return $this->redirect(['/site/index']);
    }

    public function actionSetnewPassword($key) {
        $token = Token::findBySecretKey($key);

        if ($token && $token->isSecretKeyExpire($token->expire_date)) {

            $model = new ResetPasswordForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if ($model->resetPassword($token)) {
                    Yii::$app->session->setFlash('success', 'Ваш пароль успешно изменен');
                    $email = Email::findByUserToken($key);
                    if ($email) {
                        $email->delete();
                    }
                    return $this->redirect(['/site/index']);
                }
            }
            return $this->render('setnew-password', [
                        'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'Либо неверно указан ключи или срок ссылки на изменение пароля истек, отправьте новй запрос на востановление пароля');
        return $this->redirect(['/site/index']);
    }

    public function actionLogin() {
        if (Yii::$app->request->isAjax) {
            $model = new LoginForm();
            if ($model->load(Yii::$app->request->post())) {

                if ($model->login()) {
//                    if ($model->user->role == User::IS_ADMIN) {
//                        return $this->redirect(['/admin']);
//                    } else {
//                        return $this->redirect(['user/index', 'username' => Yii::$app->user->identity->username]);
//                    }
                    return $this->redirect(['/site/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'Возможно вы не активировали свой email');
                    return $this->refresh();
                }
            }
            return $this->renderPartial('login', [
                        'model' => $model,
            ]);
        }
        return $this->redirect(['/site/index']);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->redirect(['/site/index']);
    }

    public function actionProfile() {
        $model = ($model = Profile::findOne(['user_id' => Yii::$app->user->id])) ? $model : new Profile();

        if ($model->load(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->validate()) {

                $model->file = ImageHelper::saveImage($model);


                if ($model->updateProfile($model)) {
                    Yii::$app->session->setFlash('success', 'Профиль изменен');
                } else {
                    Yii::$app->session->setFlash('error', 'Профиль не изменен');
                    Yii::error('Ошибка записи. Профиль не изменен');
                    return $this->refresh();
                }
            }
        }
        return $this->render('profile', ['model' => $model]);
    }

}
