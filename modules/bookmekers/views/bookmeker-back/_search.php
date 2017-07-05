<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bookmekers\models\search\BookmekerSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookmeker-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>


    <?= $form->field($model, 'img_medium') ?>

    <?= $form->field($model, 'img_small') ?>

    <?= $form->field($model, 'referal_token') ?>
    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'bonus') ?>

    <?php // echo $form->field($model, 'bonus_link') ?>

    <?php // echo $form->field($model, 'site_link') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
