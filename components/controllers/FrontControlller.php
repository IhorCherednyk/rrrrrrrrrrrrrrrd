<?php

namespace app\components\controllers;

use yii\filters\AccessControl;
use yii\web\Controller;

/**
 * Description of FrontControlller
 *
 * @author Stableflow
 */
class FrontControlller extends Controller {

    public $layout = '/main';
    
    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?','@'],
                    ],
                ],
            ],
        ];
    }
    
}
