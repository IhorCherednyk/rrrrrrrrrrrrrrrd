<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\pages\models\search\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Pages', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
            'id',
            'slug',
            'body:ntext',
            'title',
            'title_short',
            // 'created_at',
            // 'updated_at',
            // 'keywords',
            // 'description',
            // 'status',
            // 'is_protected',
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
