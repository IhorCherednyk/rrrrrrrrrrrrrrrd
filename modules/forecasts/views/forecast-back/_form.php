<?php

use app\modules\bookmekers\models\Bookmeker;
use app\modules\forecasts\models\Forecast;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Forecast */
/* @var $form ActiveForm */



$bookmekers = Bookmeker::find()->all();
$bookArray = ArrayHelper::map($bookmekers, 'id', 'gametournament_alias');

$this->registerJs("
    
    $(document).on('change','#forecast-match_id',function(e){
        e.preventDefault();
        submitMe();
    });
    
    $(document).on('change','#forecast-bets_type',function(e){
        
        e.preventDefault();
        submitMe();
    });

    function submitMe() {
        
        var form = $('form#w0');
        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                 $('.panel-body').html(response);
            },
            error: function (response) {
                console.log('error');
            }
        });
        
    }
    
    
");
?>

<div class="forecast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
    $form->field($model, 'match_id')->dropDownList($matchNameArray, [
        'prompt' => 'Выберите матч'
    ])
    ?>

    <?=
    $form->field($model, 'bets_type')->dropDownList($betsType, [
        'prompt' => 'Выберите прогноз'
    ])
    ?>
    <?=
    $form->field($model, 'user_choice')->dropDownList($betsArray, [
        'prompt' => 'Выберите прогноз'
    ])
    ?>
    <?=
    $form->field($model, 'bookmeker_id')->dropDownList($bookArray, [
        'prompt' => 'Выберите букмекера'
    ])
    ?>


    <?= $form->field($model, 'description')->textarea() ?>

    <?= $form->field($model, 'coins_bet')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>