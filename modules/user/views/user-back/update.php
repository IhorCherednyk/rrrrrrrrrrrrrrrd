<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\user\models\User */

$this->title = Yii::t('app', 'Update User');

$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Users') . '</span>',
    'url' => ['index'],
    'encode' => false,
    'class' => 'm-nav__link'
];
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Update User') . '</span>',
    'url' => 'javascript:;',
    'encode' => false,
    'class' => 'm-nav__link'
];
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
