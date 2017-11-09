<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\forecasts\models\search\MatchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="matches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Matches', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => 'Null',
        ],
        'columns' => [
            'gametournament_id',
            [
                'attribute' => 'team1',
                'label' => 'Team 1',
                'value' => function($model) {
                    if (!is_null($model->team1)) {
                        return $model->team1->name;
                    } else {
                        return null;
                    }
                }
            ],
            [
                'attribute' => 'team2',
                'label' => 'Team 2',
                'value' => function($model) {
                    if (!is_null($model->team2)) {
                        return $model->team2->name;
                    } else {
                        return null;
                    }
                }
            ],
            'tournament_id',
            'start_time:datetime',
            'team1_result',
            'team2_result',
            'status',
            'koff_counter',
            'match_type',
                [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Actions'),
                'headerOptions' => [
                    'width' => '50',
                ],
                'buttons' => [
                    'delete' => function($url, $model) {
                        return Html::a('<i class="icon wb-close"></i> ', ['delete', 'id' => $model->id], [
                                    'class' => 'btn-red adm-btn',
                                    'title' => Yii::t('app', 'Delete'),
                                    'data-pjax' => 1,
                                    'data-method' => 'post',
                        ]);
                    },
                    'edit' => function($url, $model) {
                        return Html::a('<i class="icon wb-pencil"></i> ', ['update', 'id' => $model->id], [
                                    'class' => 'btn-green adm-btn',
                                    'title' => Yii::t('app', 'Edit'),
                                    'data-pjax' => 0
                        ]);
                    },
                    'view' => function($url, $model) {
                        return Html::a('<i class="icon wb-eye"></i> ', ['view', 'id' => $model->id], [
                                    'class' => 'btn-green adm-btn',
                                    'title' => Yii::t('app', 'View'),
                                    'data-pjax' => 0
                        ]);
                    }
                ],
                'template' => '{edit} {delete} {view}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
