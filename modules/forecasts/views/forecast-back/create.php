<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Forecast */

$this->title = Yii::t('app', 'Create Forecast');
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Forecast') . '</span>',
    'url' => ['index'],
    'encode' => false,
    'class' => 'm-nav__link'
];
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Forecast User') . '</span>',
    'url' => 'javascript:;',
    'encode' => false,
    'class' => 'm-nav__link'
];
?>
<div class="forecast-create">

    <?=
    $this->render('_form', [
        'model' => $model,
        'matchNameArray' => $matchNameArray,
        'betsType' => $betsType,
        'betsArray' => $betsArray,
        'bookArray' => $bookArray
    ])
    ?>

</div>
