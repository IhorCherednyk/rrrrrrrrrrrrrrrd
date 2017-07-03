<?php

namespace app\components\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Description of BackController
 *
 * @author Stableflow
 */
class BackController extends \yii\web\Controller {

    public $layout = '/admin';
    
//    public function behaviors() {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'rules' => [
//                    [
//                        'allow' => true,
//                        'roles' => ['admin'],
//                    ],
//                ],
//            ],
//        ];
//    }
    
}
