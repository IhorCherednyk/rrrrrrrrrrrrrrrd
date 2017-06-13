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
$model = new LoginForm();
Modal::begin([
    'id' => 'log',
    'header' => '<div class="page-name"><h3>Вход</h3></div>'
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
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?=
        $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div>{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ])
        ?>

        <div class="form-group">
            <?= Html::submitButton('Login', ['class' => 'btn btn-success login-btn', 'name' => 'login-button']) ?>
            <a href="<?= Url::to(['/user/auth/reg']) ?>" data-toggle="modal" data-target="#reg" class="btn btn-primary">Register</a>
            <?= Html::a('Забыли пароль?', ['/auth/send-email'], ['class' => 'btn']) ?>
        </div>

        <?php ActiveForm::end();
        Pjax::end(); ?>

    </div>
</div>
<?php
Modal::end();
?>
