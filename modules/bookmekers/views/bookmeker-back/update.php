<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bookmekers\models\Bookmeker */

$this->title = 'Update Bookmeker: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bookmekers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bookmeker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
