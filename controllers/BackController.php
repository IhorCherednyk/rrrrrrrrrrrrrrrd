<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Description of BackController
 *
 * @author Stableflow
 */
class BackController extends BaseController {

    public $layout = '/main';
    
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['USER'],
                    ],
                        [
                        'allow' => true,
                        'actions' => ['about'],
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['error'],
                        'allow' => true,
                    ],
                    
                    
                ],
            ],
        ];
    }
    
}
