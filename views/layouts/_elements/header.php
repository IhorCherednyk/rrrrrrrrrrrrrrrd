<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;

AppAsset::register($this);
?>
<header class="main-header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="" class="logo"><img src="/img/site/logo.png" alt="Logo"></a>
            </div>
            <div class="col-md-9">
                <nav class="main-nav"> 
                    <?=
                    Menu::widget([
                        'options' => [
                            'class' => 'main-ul',
                        ],
                        'activeCssClass' => 'active',
                        'encodeLabels' => false,
                        'items' => [
                                [
                                'label' => \Yii::t('app', 'Кабинет'),
                                'url' => ['/user/user/logout'],
                                'visible' => !\Yii::$app->user->isGuest
                            ],
                                [
                                'label' => Yii::t('app', 'Прогнозы'),
                                'url' => ['/forecasts'],
                            ],
                                [
                                'label' => Yii::t('app', 'Букмекеры'),
                                'url' => ['/booklist'],
                            ],
                                [
                                'label' => Yii::t('app', 'Команды'),
                                'url' => ['/team/team/index'],
                            ],
                                [
                                'label' => Yii::t('app', 'Стримы'),
                                'url' => ['/streams/stream/index'],
                            ],
                                [
                                'label' => \Yii::t('app', 'Термины'),
                                'url' => ['/faq'],
                            ],
                                [
                                'label' => \Yii::t('app', 'Вход'),
                                'url' => '#',
                                'template' => '<a href="{url}" data-toggle="modal" data-target="#log">{label}</a>',
                                'visible' => \Yii::$app->user->isGuest
                            ],
                                [
                                'label' => \Yii::t('app', 'Выход'),
                                'url' => ['/user/auth/logout'],
                                'visible' => !\Yii::$app->user->isGuest
                            ],
                        ],
                    ]);
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>

