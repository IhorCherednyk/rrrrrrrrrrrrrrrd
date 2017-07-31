<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\Teams */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'second_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dotabuff_id')->textInput() ?>

    <?= $form->field($model, 'dotabuff_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_place')->textInput() ?>

    <?= $form->field($model, 'game_count')->textInput() ?>

    <?= $form->field($model, 'winrate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
