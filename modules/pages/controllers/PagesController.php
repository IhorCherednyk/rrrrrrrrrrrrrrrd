<?php

namespace app\modules\pages\controllers;

use app\components\controllers\FrontControlller;
use app\modules\pages\models\Pages;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `static` module
 */
class PagesController extends FrontControlller {

    public function behaviors() {
        return parent::behaviors();
    }


    
    public function actionShow($slug) {
        
        if (null === $model = Pages::findbySlug($slug)) {
            throw new NotFoundHttpException('Page not found');
        };
        return $this->render(
            'show', ['model' => $model]
        );
    }

}
