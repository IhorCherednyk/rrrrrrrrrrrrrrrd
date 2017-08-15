<?php

namespace app\modules\team\controllers;

use app\components\controllers\FrontControlller;
use app\modules\team\models\Teams;
use darkdrim\simplehtmldom\SimpleHTMLDom;
use Yii;
use app\helpers\ImageHelper;

/**
 * Default controller for the `team` module
 */
class TeamController extends FrontControlller {

   
    public function behaviors() {
        return parent::behaviors();
    }

    public function actionIndex() {
      
        return $this->render('index');
    }
   
}
