<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<div class="auth-profile">
        
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model->model, 'username') ?>
        <?= $form->field($model->model, 'email') ?>
        <?= $form->field($model->model, 'note') ?>
        <?= $form->field($model->model, 'skype') ?>
        <?= $form->field($model->model, 'first_name') ?>
        <?= $form->field($model->model, 'last_name') ?>
        <?= $form->field($model->model, 'avatar_path') ?>
        <?= $form->field($model, 'file')->fileInput() ?>
    
        <h2>картинка профиля</h2>
        <?php 
        
           if($model->model->avatar_path){
               echo Html::img($model->model->avatar_path);
           }else{
               echo Yii::t('app','Картинка не загруженна');
           }
       ?>
    
        <div class="form-group">
            <?= Html::submitButton('Edit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- auth-profile -->
