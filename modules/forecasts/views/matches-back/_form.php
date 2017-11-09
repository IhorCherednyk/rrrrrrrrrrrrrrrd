<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Matches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="matches-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gametournament_id')->textInput() ?>

    <?= $form->field($model, 'team1_id')->textInput() ?>

    <?= $form->field($model, 'team2_id')->textInput() ?>

    <?= $form->field($model, 'tournament_id')->textInput() ?>

    <?= $form->field($model, 'start_time')->textInput() ?>

    <?= $form->field($model, 'team1_result')->textInput() ?>

    <?= $form->field($model, 'team2_result')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'koff_counter')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
