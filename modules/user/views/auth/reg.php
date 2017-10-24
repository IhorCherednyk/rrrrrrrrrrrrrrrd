<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;
use app\modules\user\forms\RegForm;

$this->title = 'Login';
if (!isset($model)) {
    $model = new RegForm();
}
Modal::begin([
    'id' => 'reg',
]);
?>

<div class="model-wrapper-auth">
        <div class="top-register-panel">
            <ul>
                <li><a href="<?= Url::to(['/user/auth/reg']) ?>" data-toggle="modal" data-target="#log" class="btn btn-reg">Вход</a></li>
                <li  class="active"><a href="javascript:void(0);" class="btn btn-reg">Регистрация</a></li>
            </ul>
        </div>
        <?php
        
        Pjax::begin(['enablePushState' => false, 'id' => 'regform']);

        $form = ActiveForm::begin([
                    'options' => ['data-pjax' => true],
                    'method' => 'post',
                    'id' => 'reg-form',
                    'action' => '/user/auth/reg',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-sm-12 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput()->label('Имя пользователя') ?>
        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>
        <?= $form->field($model, 'password_repeat')->passwordInput()->label('Повторите пароль') ?>
        <?= $form->field($model, 'email')->input('email') ?> 



        <div class="form-group">
            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-reg mt50', 'name' => 'login-button']) ?>
        </div>


        <?php ActiveForm::end();
        Pjax::end();
        ?>

</div>
<?php
Modal::end();
?>