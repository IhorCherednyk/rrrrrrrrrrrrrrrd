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
use app\models\RegForm;

$this->title = 'Login';
$model = new RegForm();
Modal::begin([
    'id' => 'reg',
    'header' => '<div class="page-name"><h3>Вход</h3></div>'
]);
?>

<div class="row">
    <div class="col-md-12">

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
                        'labelOptions' => ['class' => 'col-lg-1 control-label'],
                    ],
        ]);
        ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>
        <?= $form->field($model, 'email')->input('email') ?> 



        <div class="form-group">
            <?= Html::submitButton('Sign Up', ['class' => 'btn btn-primary custom-btn', 'name' => 'login-button']) ?>
        </div>


        <?php ActiveForm::end();
        Pjax::end(); ?>

    </div>
</div>
<?php
Modal::end();
?>