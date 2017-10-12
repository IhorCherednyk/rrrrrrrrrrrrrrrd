<?php

namespace app\components\widgets;

use app\modules\forecasts\models\Matches;
use yii\base\Widget;

class NearestMatchesWidget extends Widget{
    

    public function init() {
        parent::init();
    }

    public function run() {
        
        $matches = Matches::findForWidget();

        if (!is_null($matches)) {
            return $this->render('nearest_matches', ['data' => $matches]);
        }
    }

}
