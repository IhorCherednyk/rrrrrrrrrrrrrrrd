<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Profile */
/* @var $form ActiveForm */
?>
<style type="text/css">
	.succsess {
		background-color: #F9EDBE;
		margin-bottom: 20px;
	}
</style>
<div class="auth-profile">
	<h1>Profile</h1>
	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'first_name') ?>
	<?= $form->field($model, 'last_name') ?>
	<?= $form->field($model, 'hobbies') ?>
	<?= $form->field($model, 'lovely_films') ?>
	<?= $form->field($model, 'lovely_book') ?>
	<?= $form->field($model, 'file')->fileInput()->label('Загрузите картинку с вашего компьютера') ?>
	<div class="img-wrapper">
	<h2>Текущая картинка вашего профиля</h2>

		<?php 

		if($model->avatar_path){
			echo Html::img($model->avatar_path);
		}else{
			echo Html::img('/img/noimg.png');
		}
		?>
	</div>
	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success cust-success']) ?>
	</div>
	<?php ActiveForm::end(); ?>

</div><!-- auth-profile -->
