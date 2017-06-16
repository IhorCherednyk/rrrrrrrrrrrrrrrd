<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<div class="set-password">
    <h3 class="mt25">Введите новый пароль</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
    <?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторите пароль') ?>
    <div class="form-group">
        <?= Html::submitButton('Установить пароль', ['class' => 'btn btn-reg']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- auth-profile -->

