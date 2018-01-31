<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\search\ForecastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forecast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'match_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'bookmeker_id') ?>

    <?= $form->field($model, 'bets_type') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'bookmeker_koff') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'match_started') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'team1') ?>

    <?php // echo $form->field($model, 'team2') ?>

    <?php // echo $form->field($model, 'coins_bet') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
