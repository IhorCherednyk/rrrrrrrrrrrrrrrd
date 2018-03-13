<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Forecast */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Forecast',
        ]) . $model->id;

$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Forecast') . '</span>',
    'url' => ['index'],
    'encode' => false,
    'class' => 'm-nav__link'
];
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Update Forecast') . '</span>',
    'url' => 'javascript:;',
    'encode' => false,
    'class' => 'm-nav__link'
];
?>
<div class="forecast-update">

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
