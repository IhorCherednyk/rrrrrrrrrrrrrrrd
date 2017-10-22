<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<?php $this->title = 'Кабинет'?>
<div class="col-md-5">
    <div id="auth-profile">

        <?php
        if ($model->model->avatar_path) {
            echo Html::img($model->model->avatar_path);
        } else {
            echo Yii::t('app', 'Картинка не загруженна');
        }
        ?>
        <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'id' => 'profile-form',
                    'action' => '/user/user/profile',
        ]);
        ?>
        <?= $form->field($model, 'file')->fileInput() ?>
        
        <?= $form->field($model->model, 'username') ?>
        <?= $form->field($model->model, 'email') ?>
        <?= $form->field($model->model, 'note')->textarea() ?>
        <?= $form->field($model->model, 'skype') ?>
        
        <div class="form-group">
            <?= Html::submitButton('Edit', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
    

