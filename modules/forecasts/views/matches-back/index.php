<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\forecasts\models\search\MatchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Matches');
$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . $this->title . '</span>',
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => 'Null',
        ],
        'columns' => [
                [
                'attribute' => 'gametournament_id',
                'label' => 'gtmId',
                'headerOptions' => [
                    'width' => '60',
                ],
            ],
                [
                'attribute' => 'tournament_id',
                'label' => 'tourId',
                'headerOptions' => [
                    'width' => '60',
                ],
            ],
                [
                'attribute' => 'team1',
                'label' => 'Team 1',
                'format' => 'raw',
                'value' => function($model) {
                    if (!is_null($model->team1)) {
                        return $model->team1->name . Html::img($model->team1->img, ['class' => 'grid-img']);
                    } else {
                        return null;
                    }
                }
            ],
                [
                'attribute' => 'team2',
                'label' => 'Team 2',
                'format' => 'raw',
                'value' => function($model) {
                    if (!is_null($model->team2)) {
                        return $model->team2->name . Html::img($model->team2->img, ['class' => 'grid-img']);
                    } else {
                        return null;
                    }
                }
            ],
            'start_time:datetime',
                [
                'attribute' => 'team1_result',
                'contentOptions' => [
                    'style' => 'font-weight: bold;text-align: center;'
                ],
                'headerOptions' => [
                    'width' => '60',
                ],
                'value' => function($model) {
                    if (!is_null($model->team1_result)) {
                        return $model->team1_result;
                    } else {
                        return '-';
                    }
                }
            ],
                [
                'attribute' => 'team2_result',
                'headerOptions' => [
                    'width' => '60',
                ],
                'contentOptions' => [
                    'style' => 'font-weight: bold;text-align: center;'
                ],
                'value' => function($model) {
                    if (!is_null($model->team1_result)) {
                        return $model->team1_result;
                    } else {
                        return '-';
                    }
                }
            ],
                [
                'attribute' => 'status',
                'filter' => $searchModel->getStatusArray(),
                'format' => 'raw',
                'contentOptions' => [
                    'style' => 'text-align: center'
                ],
                'value' => 'statusName'
            ],
                [
                'attribute' => 'match_type',
                'filter' => $searchModel->getTypeArray(),
                'format' => 'raw',
                'contentOptions' => [
                    'style' => 'text-align: center'
                ],
                'value' => 'typeName'
            ],
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
    <?php Pjax::end(); ?></div>
