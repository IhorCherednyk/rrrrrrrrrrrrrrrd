<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\modules\setting\helpers\SettingHelper;


/**
 * Description of BobController
 *
 * @author Anastasiya
 */
class BobController extends FrontControlller
{
    public function actionIndex()
    {
        return $this->render('index');
        
    }
}
