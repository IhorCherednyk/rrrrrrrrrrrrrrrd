<?php

namespace app\modules\forecasts\controllers;

use app\components\controllers\FrontControlller;
use app\modules\forecasts\models\Matches;
use yii\data\ActiveDataProvider;

class ForecastController extends FrontControlller {

    public function actionIndex() {
        
        $query = Matches::find()->where(['status' => Matches::NOT_COMPLETE]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', ['listDataProvider' => $dataProvider]);
    }

}
