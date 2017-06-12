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
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet"> 
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="main-wrapper">

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
                                    'encodeLabels' => false,
                                    'items' => [
                                            [
                                            'label' => Yii::t('app', 'Прогнозы'),
                                            'url' => ['/admin/user/index'],
                                        ],
                                            [
                                            'label' => Yii::t('app', 'Букмекеры'),
                                            'url' => ['/user/index'],
                                        ],
                                            [
                                            'label' => Yii::t('app', 'Команды'),
                                            'url' => ['/user-messages/incoming-message'],
                                        ],
                                            [
                                            'label' => Yii::t('app', 'Стримы'),
                                            'url' => ['/auth/reg'],
                                            'visible' => \Yii::$app->user->isGuest
                                        ],
                                            [
                                            'label' => \Yii::t('app', 'Термины'),
                                            'url' => ['/auth/profile'],
                                            'visible' => \Yii::$app->user->isGuest
                                        ],
                                            [
                                            'label' => \Yii::t('app', 'Вход'),
                                            'url' => ['/auth/login'],
                                            'visible' => \Yii::$app->user->isGuest
                                        ],
                                            [
                                            'label' => \Yii::t('app', 'Выход'),
                                            'url' => ['/auth/logout'],
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


            <div class="main-content-wrapper">
                <div class="container">
                    <?= $content ?>
                </div>
            </div>

            <footer id="main-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="nk-widget-title"><span class="text-main-1">Наши</span> Контакты</h4>
                            <form action="php/contact.php" class="nk-form nk-form-ajax" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="email" class="form-control input-contact" name="email" placeholder="Email *" aria-required="true">
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control input-contact" name="name" placeholder="Имя *" aria-required="true">
                                    </div>
                                </div>
                                <textarea class="form-control text-area-contact" name="message" rows="5" placeholder="Сообщение *" aria-required="true"></textarea>
                                <button class="btn btn-rounded btn-color-white mt20 ">
                                    <span>Отправить</span>
                                    <span class="icon"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></span>
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="nk-widget">
                                <h4 class="nk-widget-title"><span class="text-main-1">Последние </span>новости</h4>
                                <div class="nk-widget-content">
                                    <div class="row vertical-gap sm-gap">

                                        <div class="col-lg-6">
                                            <div class="footer-news">
                                                <a href="#" class="news-link">
                                                    <span class="nk-post-image">
                                                        <img src="/img/site/post-1-sm.jpg" alt="">
                                                    </span>

                                                    <div class="footer-news-wrapper">
                                                        <p>Smell magic in the air. Or maybe barbecue</p>
                                                        <span class="fa fa-calendar"></span>
                                                        <span class="calendar-date">
                                                            Sep 18, 2016
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="footer-news">
                                                <a href="#" class="news-link">
                                                    <span class="nk-post-image">
                                                        <img src="/img/site/post-1-sm.jpg" alt="">
                                                    </span>

                                                    <div class="footer-news-wrapper">
                                                        <p>Smell magic in the air. Or maybe barbecue</p>
                                                        <span class="fa fa-calendar"></span>
                                                        <span class="calendar-date">
                                                            Sep 18, 2016
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="footer-news">
                                                <a href="#" class="news-link">
                                                    <span class="nk-post-image">
                                                        <img src="/img/site/post-1-sm.jpg" alt="">
                                                    </span>

                                                    <div class="footer-news-wrapper">
                                                        <p>Smell magic in the air. Or maybe barbecue</p>
                                                        <span class="fa fa-calendar"></span>
                                                        <span class="calendar-date">
                                                            Sep 18, 2016
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="footer-news">
                                                <a href="#" class="news-link">
                                                    <span class="nk-post-image">
                                                        <img src="/img/site/post-1-sm.jpg" alt="">
                                                    </span>

                                                    <div class="footer-news-wrapper">
                                                        <p>Smell magic in the air. Or maybe barbecue</p>
                                                        <span class="fa fa-calendar"></span>
                                                        <span class="calendar-date">
                                                            Sep 18, 2016
                                                        </span>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="copyright">
                        Copyright © 2017 | Code <a href="https://themeforest.net/user/_nk?ref=_nK" target="_blank">nK</a>, design <a href="https://themeforest.net/user/syatweb?ref=_nK" target="_blank">SYATWEB</a>
                        <p>18+ Dota-prognoz не организует игры на деньги. Контент носит информационный характер. © 2012-2017 Dota-prognoz.ru</p>
                    </div>
                </div>
                 
            </footer>
        </div>
        <img class="nk-page-background-top" src="/img/site/top-bg2.png" alt="">
        <img class="nk-page-background-bottom" src="/img/site/bg-bottom.png" alt="">
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
