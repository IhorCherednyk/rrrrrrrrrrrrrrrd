<?php

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use app\modules\user\forms\ProfileForm;
use app\modules\user\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

class UserController extends FrontControlller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['index'],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['profile'], // add all actions to take guest to login page
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        return $this->render('index', [
                    'model' => '',
        ]);
    }

    public function actionProfile() {
        $model = new ProfileForm(User::findOne(Yii::$app->user->id));

        if ($model && !empty(Yii::$app->request->post())) {

            $model->file = UploadedFile::getInstance($model, 'file');


            if ($model->updateProfile(Yii::$app->request->post())) {
                Yii::$app->session->setFlash('success', 'Профиль изменен');
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка, Профиль не изменен');
            }
        }

        return $this->render('profile', ['model' => $model]);
    }

}
