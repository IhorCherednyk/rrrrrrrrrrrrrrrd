<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\bootstrap\Html;
use yii\web\View;
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
                        'activateParents' => true,
                        'submenuTemplate' => "\n<span class=\"m-menu__arrow\"></span>\n<ul class=\"m-menu__subnav\">{items}\n</ul>\n",
                        'encodeLabels' => false,
                        'items' => [
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
                                'label' => Html::img(!empty(Yii::$app->user->identity->avatar_path) ?
                                                Yii::$app->user->identity->avatar_path : '/img/site/noavatar.png', ['class' => 'menu-avatar']),
                                'url' => '#',
                                'visible' => !\Yii::$app->user->isGuest,
                                'template' => '<a href="{url}" class="open-menu">{label}</a>',
                                'options' => [
                                    'class' => 'submenu',
                                ],
                                'items' => [
                                        [
                                        'template' => '<div class="header-dropdown" class="clearfix">'
                                        . '<div class="avatar_image">'
                                        . '<img src="/img/site/noavatar.png" alt="">'
                                        . '</div>'
                                        . '<div class="user_status">'
                                        . '<ul>'
                                        . '<li>Статус: <span>Bronze</span></li>'
                                        . '<li>Имя: <span>Admin</span></li>'
                                        . '<li>'
                                        . '<img src="/img/site/coin.png">'
                                        . ((Yii::$app->user->identity->coins <= 0) 
                                            ? '' 
                                            : Html::a('<i class="fa fa-refresh"></i>', 'javascript:;', ['id' => 'refresh']))
                                        . '<span id="coins">' 
                                        . Yii::$app->user->identity->coins 
                                        . '</span>'
                                        . '</li>'
                                        . '</ul>'
                                        . '</div>'
                                        . '<div style="clear: both;"></div>'
                                        . '</div>',
                                        'url' => '#',
                                    ],
                                        [
                                        'label' => Yii::t('app', 'Кабинет'),
                                        'options' => [
                                            'class' => 'submenu-li',
                                        ],
                                        'url' => ['/user/user/profile'],
                                    ],
                                        [
                                        'label' => Yii::t('app', 'Выход'),
                                        'options' => [
                                            'class' => 'submenu-li',
                                        ],
                                        'url' => ['/user/auth/logout'],
                                    ],
                                ]
                            ],
                        ],
                    ]);
                    ?>
                </nav>
            </div>
        </div>
    </div>
</header>

<!--<div id="avatar_image_wrapper" class="clearfix">
            <div class="avatar_image">
                <img src="/img/site/noavatar.png" alt="">            </div>
            <div class="user_status">
                <ul>
                    <li>Статус: <span>Bronze</span></li>
                    <li>Прогнозов: <span>1234</span></li>
                    <li>Побед: <span>442</span></li>
                    <li>% Побед: <span>60%</span></li>
                </ul>
            </div>
            <div style="clear: both;"></div>
            <div class="avatar-error-message"></div>
        </div>-->