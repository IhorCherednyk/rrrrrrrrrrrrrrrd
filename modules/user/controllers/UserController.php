<?php

namespace app\modules\user\controllers;

use app\components\controllers\FrontControlller;
use yii\filters\AccessControl;

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
//        $model = ($model = Profile::findOne(['user_id' => Yii::$app->user->id])) ? $model : new Profile();
//
//        if ($model->load(Yii::$app->request->post())) {
//
//            $model->file = UploadedFile::getInstance($model, 'file');
//
//            if ($model->validate()) {
//
//                $model->file = ImageHelper::saveImage($model);
//
//
//                if ($model->updateProfile($model)) {
//                    Yii::$app->session->setFlash('success', 'Профиль изменен');
//                } else {
//                    Yii::$app->session->setFlash('error', 'Профиль не изменен');
//                    Yii::error('Ошибка записи. Профиль не изменен');
//                    return $this->refresh();
//                }
//            }
//        }
        return $this->render('profile', ['model' => '']);
    }

}
