<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<div class="auth-profile">
    <h3 class="mt25">Введите ваш email и мы вышлем вам письмо с подтверждением о смене пароля на почту</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email') ?>
    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- auth-profile -->
