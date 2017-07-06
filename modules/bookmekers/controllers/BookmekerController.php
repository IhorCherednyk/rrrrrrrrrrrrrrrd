<?php

namespace app\modules\bookmekers\controllers;

use app\components\controllers\FrontControlller;
use app\modules\bookmekers\models\Bookmeker;
use yii\data\ActiveDataProvider;

/**
 * Default controller for the `bookmekers` module
 */
class BookmekerController extends FrontControlller {

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionBookList() {
        $query = Bookmeker::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            
        ]);
        
        return $this->render('book-list', ['listDataProvider' => $dataProvider]);
    }

}
