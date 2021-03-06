<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use app\modules\user\forms\SendEmailForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
Modal::begin([
    'id' => 'mail',
]);
if(!isset($model)){
    $model = new SendEmailForm();
}
?>
<div class="model-wrapper-auth">
    <div class="top-register-panel">
        <ul>
            <li  class="active solo"><a href="javascript:void(0);" class="btn btn-reg">Восстановление Пароля</a></li>
        </ul>
    </div>
    <div class="auth-profile">
        <?php
        Pjax::begin(['enablePushState' => false, 'id' => 'sendemail']);
        $form = ActiveForm::begin([
                    'options' => ['data-pjax' => true],
                    'method' => 'post',
                    'id' => 'send-email',
                    'action' => '/user/auth/reset-password',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-sm-12 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'email')->label('Введите свой email') ?>
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-reg']) ?>
        </div>
        <?php
            ActiveForm::end();
            Pjax::end();
        ?>

    </div>
</div>
<?php
Modal::end();
?>