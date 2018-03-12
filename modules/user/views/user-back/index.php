<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\user\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');

$this->params['breadcrumbs'][] = [
    'label' => '<span class="m-nav__link-text">' . Yii::t('app', 'Users') . '</span>',
    'url' => 'javascript:;',
    'encode' => false,
    'class' => 'm-nav__link'
];
?>
<div class="m-portlet__body">

    <p class="button-area">
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
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
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => 'Null',
        ],
        'columns' => [
                [
                'attribute' => 'id',
                'label' => 'id',
                'headerOptions' => [
                    'width' => '60',
                ],
                'contentOptions' => [
//                    'class' => 'id'
                ]
            ],
            'username',
            'email:email',
//            'password_hash',
            'status',
            // 'auth_key',
            // 'created_at',
            // 'updated_at',
            'first_name',
            'last_name',
            // 'role',
            // 'last_login_date',
            // 'email_activation_key:email',
            // 'note:ntext',
            'skype',
            // 'avatar_path',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app', 'Actions'),
                'headerOptions' => [
                    'width' => '150'
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
                    'loginAs' => function($url, $model) {
                        return Html::a('<i class="fa fa-sign-in"></i> ', ['login-as', 'id' => $model->id], [
                                    'class' => 'btn btn-outline-info m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill',
                                    'title' => Yii::t('app', 'Login As'),
                                    'data-pjax' => 1,
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
                'template' => '{edit}{delete}{loginAs}',
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
