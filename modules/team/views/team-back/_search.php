<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\team\models\search\TeamsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="teams-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'second_name') ?>

    <?= $form->field($model, 'img') ?>

    <?= $form->field($model, 'dotabuff_id') ?>

    <?php // echo $form->field($model, 'dotabuff_link') ?>

    <?php // echo $form->field($model, 'total_place') ?>

    <?php // echo $form->field($model, 'game_count') ?>

    <?php // echo $form->field($model, 'winrate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
