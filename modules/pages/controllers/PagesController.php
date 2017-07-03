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

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionShow($slug) {
        if (null === $model = Pages::find()->bySlug($slug)->one()) {
            throw new NotFoundHttpException('Page not found');
        };
        return $this->renderPartial(
                        'show', ['model' => $model]
        );
    }

}
