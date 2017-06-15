<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
Modal::begin([
    'id' => 'mail',
    'header' => '<h3 class="modal-email">Введите новый пароль</p>'
]);
if(!isset($model)){
    $model = new ResetPasswordForm();
}
?>
<div class="auth-profile">
    
    <?php
        Pjax::begin(['enablePushState' => false, 'id' => 'setpassword']);
        $form = ActiveForm::begin([
                'options' => ['data-pjax' => true],
                'method' => 'post',
                'id' => 'set-password',
                'action' => '/user/auth/setnew-password',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-sm-12 control-label'],
                ],
    ]);
    ?>

    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Set new password', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- auth-profile -->
<?php
Modal::end();
?>
