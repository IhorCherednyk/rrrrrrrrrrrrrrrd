<?php
/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

use app\models\LoginForm;
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
    'header' => '<h3>Вход</h3>'
]);
?>

<div class="row">
    <div class="col-md-12">

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
            <a href="<?= Url::to(['/user/auth/reg']) ?>" data-toggle="modal" data-target="#reg" class="btn btn-reg">Зарегестрироваться</a>
            <?= Html::a('Забыли пароль?', ['/user/auth/send-email'], ['class' => 'forgot-password','data-toggle' => 'modal', 'data-target' => '#mail']) ?>
        </div>

        <?php ActiveForm::end();
        Pjax::end(); ?>

    </div>
</div>
<?php
Modal::end();
?>
