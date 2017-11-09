<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Matches */

$this->title = 'Create Matches';
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matches-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
