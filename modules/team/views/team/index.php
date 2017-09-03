<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\team\models\search\TeamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Teams';
?>


<section class="main-section teams">
    <div class="table-responsive">

        <?php Pjax::begin(); ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}{pager}',
            'tableOptions' => ['class' => 'table table-condensed table-hover vam'],
            'columns' => [
                    [
                    'attribute' => 'total_place',
                    'label' => 'Место',
                    'headerOptions' => ['width' => '50'],
                    'contentOptions' => ['width' => '50'],
                    'value' => function($model) {
                        return $model->total_place;
                    }
                ],
                    [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'label' => 'Команда',
                    'headerOptions' => ['class' => 'text-left team'],
                    'contentOptions' => ['class' => 'text-left team'],
                    'value' => function($model) {
                        $template = '<img class="team_img" src=' . $model->img . '><span class="team_name">' . $model->name . '</span>';
                        return $template;
                    }
                ],
                    [
                    'attribute' => 'game_count',
                    'label' => 'Всего игр',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function($model) {
                        return $model->game_count;
                    }
                ],
                [
                    'attribute' => 'winrate',
                    'label' => 'Побед',
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'],
                    'value' => function($model) {
                        return $model->winrate;
                    }
                ],
                    [
                    'attribute' => 'dotabuff_link',
                    'label' => 'Подробнее',
                        'format' => 'raw',
                    'headerOptions' => ['class' => 'text-right'],
                    'contentOptions' => ['class' => 'text-right'],
                    'value' => function($model) {
                        return '<a href="https://ru.dotabuff.com'. $model->dotabuff_link .'" class="dotabuff">dotabuff</a>';
                    }
                ]

            ],
        ]);
        ?>
        <?php Pjax::end(); ?>
    </div>

</section>
