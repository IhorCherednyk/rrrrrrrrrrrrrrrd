<?php

namespace app\modules\bookmekers\controllers;

use app\components\controllers\FrontControlller;

/**
 * Default controller for the `bookmekers` module
 */
class BookmekerController extends FrontControlller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
