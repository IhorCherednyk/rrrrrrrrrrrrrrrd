<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\bookmekers\models\search\BookmekerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookmekers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookmeker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bookmeker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(['id' => 'book-grid', 'enablePushState' => false]); ?>
        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'img_small',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->img_small);
                }
            ],
            [
                'attribute' => 'img_medium',
                'format' => 'raw',
                'value' => function($model) {
                    return Html::img($model->img_medium);
                }
            ],
            'referal_token',
            'name',
            // 'body:ntext',
            // 'bonus',
            // 'bonus_link',
            // 'site_link',

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
    ]); ?>
<?php Pjax::end(); ?></div>
