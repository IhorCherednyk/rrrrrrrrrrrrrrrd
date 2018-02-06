<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Forecast */

$this->title = Yii::t('app', 'Create Forecast');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forecasts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forecast-create">

    <h1><?= Html::encode($this->title) ?></h1>

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
