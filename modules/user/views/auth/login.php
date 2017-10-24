<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

use app\modules\user\forms\LoginForm;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\Pjax;

$this->title = 'Login';
if(!isset($model)){
    $model = new LoginForm();
}
Modal::begin([
    'id' => 'log',
]);
?>
<div class="model-wrapper-auth">
        <div class="top-register-panel">
            <ul>
                <li class="active"><a href="javascript:void(0);" class="btn btn-reg">Вход</a></li>
                <li><a href="<?= Url::to(['/user/auth/reg']) ?>" data-toggle="modal" data-target="#reg" class="btn btn-reg">Регистрация</a></li>
            </ul>
        </div>
            

        <?php
        Pjax::begin(['enablePushState' => false, 'id' => 'loginform']);
        $form = ActiveForm::begin([
                    'options' => ['data-pjax' => true],
                    'method' => 'post',
                    'id' => 'login-form',
                    'action' => '/user/auth/login',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'col-sm-12 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput()->label('Имя пользователя') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

        <?=
        $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"remember\">{input}{label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])->label('Запомнить меня')
        ?>

        <div class="form-group">
            <?= Html::submitButton('Войти', ['class' => 'btn btn-reg login-button', 'name' => 'login-button']) ?>
            <?= Html::a('Забыли пароль?', ['/user/auth/reset-password'], ['class' => 'forgot-password','data-toggle' => 'modal', 'data-target' => '#mail']) ?>
            <?= Html::a('Забыли пароль?', ['/user/auth/steam-login'], ['class' => 'forgot-password']) ?>
            <?= Html::a('Не приходит активационное письмо?', ['/user/auth/send-reactivate-email'], ['class' => 'forgot-password','data-toggle' => 'modal', 'data-target' => '#reactivatemail']) ?>
        </div>

        <?php ActiveForm::end();
        Pjax::end(); ?>


<?php
Modal::end();
?>
</div>