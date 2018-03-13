<?php

use app\modules\forecasts\models\search\ForecastSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel ForecastSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('app', 'Forecasts');
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Users') . '</span>',
    'url' => 'javascript:;',
    'encode' => false,
    'class' => 'm-nav__link'
];
?>
<div class="m-portlet__body">

    <p class="button-area">
        <?= Html::a(Yii::t('app', 'Create Forecast'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    Pjax::begin([
        'id' => 'user',
        'enablePushState' => false
    ]);
    ?>

    <?=
    GridView::widget([
        'tableOptions' => Yii::$app->params['admin.grid.tableOptions'],
        'options' => Yii::$app->params['admin.grid.options'],
        'headerRowOptions' => Yii::$app->params['admin.grid.headerRowOptions'],
        'pager' => Yii::$app->params['admin.grid.pager'],
        'dataProvider' => $dataProvider,
        'layout' => '{items}{pager}',
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'id',
            'match_id',
            'user_id',
            'bookmeker_id',
            'bets_type',
            // 'status',
            // 'bookmeker_koff',
            // 'description:ntext',
            // 'match_started',
            // 'created_at',
            // 'updated_at',
            // 'team1',
            // 'team2',
            // 'coins_bet',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Actions'),
                'headerOptions' => [
                    'width' => '100'
                ],
                'contentOptions' => [
                    'class' => 'actions-column'
                ],
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Html::a('<i class="la la-trash"></i> ', ['delete', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill',
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-pjax' => 1,
                                    'data-method' => 'post',
                                    'data-confirm' => Yii::t('app', 'Are you sure you want to delete this user?'),
                        ]);
                    },
                    'edit' => function($url, $model) {
                        return Html::a('<i class="la la-edit"></i> ', ['update', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-success m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill',
                                    'title' => Yii::t('app', 'Edit'),
                                    'data-pjax' => 0
                        ]);
                    }
                ],
                'template' => '{edit}{delete}{loginAs}{active}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
