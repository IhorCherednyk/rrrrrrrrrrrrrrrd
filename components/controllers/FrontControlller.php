<?php

namespace app\components\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\setting\helpers\SettingHelper;

/**
 * Description of FrontControlller
 *
 * @author Stableflow
 */
class FrontControlller extends \yii\web\Controller {

    public $layout = '/main';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }
    
    
}
