<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\search\MatchesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matches-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'gametournament_id') ?>

    <?= $form->field($model, 'team1_id') ?>

    <?= $form->field($model, 'team2_id') ?>

    <?= $form->field($model, 'tournament_id') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'team1_result') ?>

    <?php // echo $form->field($model, 'team2_result') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'koff_counter') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
