<?php

use dosamigos\fileupload\FileUpload;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<?php $this->title = 'Кабинет'; //D($model->errors);?>
<div class="col-md-4">
    <div id="auth-profile">

        <div id="avatar_image_wrapper" class="clearfix">
            <div class="avatar_image">
                <?= Html::img(($model->model->avatar_path) ? $model->model->avatar_path : '/img/site/noavatar.png')?>
            </div>
            <div class="user_status">
                <ul>
                    <li>Статус: <span>Bronze</span></li>
                    <li>Прогнозов: <span>1234</span></li>
                    <li>Побед: <span>442</span></li>
                    <li>% Побед: <span>60%</span></li>
                </ul>
            </div>
            <div style="clear: both;"></div>
            <div class="avatar-error-message"><?= (($model->hasErrors('file'))) ? $model->getFirstErrors()['file'] : ''; ?></div>
        </div>

        <?php
        $form = ActiveForm::begin([
                    'method' => 'post',
                    'id' => 'profile-form',
                    'action' => '/user/user/profile',
        ]);
        ?>
        <?=
        FileUpload::widget([
            'model' => $model,
            'attribute' => 'file',
            'plus' => true,
            'url' => ['/user/user/profile'], // your url, this is just for demo purposes,
            'clientEvents' => [
                'fileuploaddone' => 'function(e, data) {
                                    $(document).find("#avatar_image_wrapper").replaceWith($(data.result).find("#avatar_image_wrapper"));
                                }',
                'fileuploadadd' => 'function(e, data) {
                    console.log(data.files[0].error)
                                    var fileType = data.files[0].name.split(".").pop(), allowdtypes = "jpeg,jpg,png";
                                        if (allowdtypes.indexOf(fileType) < 0) {
                                            $(document).find("#avatar_image_wrapper .avatar-error-message").text("Поддерживаются только файлы с разширением: .png, .jpg, .jpeg")
                                            return false;
                                        }

                                }',
                'fileuploadfail' => 'function(e, data) {
                                    console.log(e);
                                    console.log(data);
                                }',
            ],
        ]);
        ?>

        <div class="user-form-fields">
            <?= $form->field($model->model, 'username')->label('Имя') ?>
            <?= $form->field($model->model, 'email') ?>
            <?= $form->field($model->model, 'skype') ?>
            <?= $form->field($model->model, 'note')->textarea()->label('О себе') ?>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Обновить', ['class' => 'btn btn-fileinput-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>

<div class="col-md-8">
    <div id="auth-profile">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
   
</div>
