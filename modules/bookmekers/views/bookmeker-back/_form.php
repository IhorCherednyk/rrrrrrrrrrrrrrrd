<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model app\modules\bookmekers\models\Bookmeker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookmeker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'referal_token')->textInput(['maxlength' => true]) ?>

    <?=
    $form->field($model, 'body')->widget(CKEditor::className(), [
        'options' => ['rows' => 6,'ignoreEmptyParagraph' => false],// Попросить Жеку показать как искать
        'preset' => 'custom',
        'clientOptions' => [
            'filebrowserImageUploadUrl' => '/file/image'
        ]
    ])
    ?>

    <?= $form->field($model, 'bonus')->textInput() ?>
    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'bonus_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'site_link')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filemedium_img')->fileInput()->label('Средняя картинка') ?>
    <?= $form->field($model, 'filesmall_img')->fileInput()->label('маленькая картинка') ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
