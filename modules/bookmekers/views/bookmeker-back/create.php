<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bookmekers\models\Bookmeker */

$this->title = 'Create Bookmeker';
$this->params['breadcrumbs'][] = ['label' => 'Bookmekers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookmeker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
