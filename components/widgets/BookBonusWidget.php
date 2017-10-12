<?php

namespace app\components\widgets;

use app\modules\bookmekers\models\Bookmeker;
use yii\base\Widget;

class BookBonusWidget extends Widget{
    public function init() {
        parent::init();
    }

    public function run() {
        
        $book = Bookmeker::findForWidget();

        if (!is_null($book)) {
            return $this->render('book_bonus', ['data' => $book]);
        }
    }

}
