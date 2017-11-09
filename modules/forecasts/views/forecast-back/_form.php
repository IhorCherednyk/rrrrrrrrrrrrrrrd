<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\forecasts\models\Forecast */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(" 
        $(function(){
            
            $('.select2').select2();
            
        });", \yii\web\View::POS_END);
?>

<div class="forecast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

    $matchNameArray = [];
    
    foreach ($matches as $key => $match) {
        $matchNameArray[$match['id']] = $match['team1']['name'] . ' vs ' . $match['team2']['name'];
    }

    ?>
    
    <?= $form->field($model, 'match_id')->dropDownList($matchNameArray, [
        'class' => 'select2',
        'prompt' => 'Выберете матч'
    ])
    ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'bookmeker_id')->textInput() ?>
    
    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'bookmeker_koff')->textInput() ?>

    <?= $form->field($model, 'user_koff')->textInput() ?>



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
