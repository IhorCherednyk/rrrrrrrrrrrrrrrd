<?php
/* @var $this View */
/* @var $content string */

use app\assets\AppAsset;
use app\components\widgets\TwitchStreamsWidget;
use yii\helpers\Html;
use yii\web\View;

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

            <?= $this->render('_elements/header'); ?>


            <div class="main-content-wrapper">
                <div class="container">
                    <?php if (Yii::$app->session->getFlash('success')): ?>
                        <div class="nk-info-box text-success">
                            <div class="nk-info-box-icon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </div>
                            <?= Html::tag('h3', Yii::$app->session->getFlash('success')) ?>
                        </div>
                    <?php endif; ?>

                    <?php if (Yii::$app->session->getFlash('error')): ?>
                        <div class="nk-info-box text-danger">
                            <div class="nk-info-box-icon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </div>
                            <?= Html::tag('h3', Yii::$app->session->getFlash('error')) ?>
                        </div>
                    <?php endif; ?>
                    <div class="page-name">
                        <h3><?= $this->title ?></h3>
                    </div>
                    <div class="row">
                        <!--КОНТЕНТ-->
                        <div class="col-md-8">
                        <?= $content ?>
                        </div>
                        <!--КОНТЕНТ-->
                        <!--CСАЙДБАР-->
                        <div class="col-md-4">
                            <aside>
                                <div class="top-expert sidebar-block">
                                    <h4 class="sidebar-header">
                                        <span><span class="text-main-1">Топ</span> прогнозистов</span>
                                    </h4>

                                    <ul class="sidebar-content">
                                        <li class="header-expert">
                                            <span class="expert-name-title text-left">Имя</span>
                                            <span class="expert-procent-title text-right">% прохода</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>
                                        <li class="item">
                                            <span class="expert-name"><a href="#">Boris12345</a></span>
                                            <span class="expert-procent">35%</span>
                                        </li>

                                    </ul>

                                </div>

                                <div class="best-sale sidebar-block">
                                    <h4 class="sidebar-header">
                                        <span><span class="text-main-1">Бонусы</span> букмекеров</span>
                                    </h4>
                                    <ul class="sidebar-content">
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/pari_match.png" alt=""></span>
                                                <span class="bonus dc va text-right">50$</span>
                                            </a>
                                        </li>
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/williamhill_original.png" alt=""></span>
                                                <span class="bonus dc va text-right">10$</span>
                                            </a>
                                        </li>
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/pinnacle.png" alt=""></span>
                                                <span class="bonus dc va text-right">100$</span>
                                            </a>
                                        </li>
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/pari_match.png" alt=""></span>
                                                <span class="bonus dc va text-right">50$</span>
                                            </a>
                                        </li>
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/williamhill_original.png" alt=""></span>
                                                <span class="bonus dc va text-right">10$</span>
                                            </a>
                                        </li>
                                        <li class="book-bonus">
                                            <a href="" class="tbl">
                                                <span class="bonus-img dc"><img src="img/pinnacle.png" alt=""></span>
                                                <span class="bonus dc va text-right">100$</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>

                                <div class="sidebar-block closest-match">
                                    <h4 class="sidebar-header">
                                        <span><span class="text-main-1">Ближайшие</span> игры</span>
                                    </h4>

                                    <ul>
                                        <li class="match sidebar-content">
                                            <a href="" class="tbl">
                                                <div class="team-1-wrap dc">
                                                    <span class="team-img team-img-featurue"><img src="img/lgd.png" alt=""></span>
                                                    <span class="team-name team-name-featurue">Lgd</span>
                                                </div>
                                                <div class="vs dc">
                                                    <span><img src="img/vs1.png" alt=""></span>
                                                    <span class="match-time"> 02 июня, 17:00 </span>
                                                </div>
                                                <div class="team-2-wrap dc">
                                                    <span class="team-img team-img-featurue"><img src="img/og.png" alt=""></span>
                                                    <span class="team-name team-name-featurue">og</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="match sidebar-content">
                                            <a href="" class="tbl">
                                                <div class="team-1-wrap dc">
                                                    <span class="team-img team-img-featurue"><img src="img/vp.png" alt=""></span>
                                                    <span class="team-name team-name-featurue">Danish Bears</span>
                                                </div>
                                                <div class="vs dc">
                                                    <span><img src="img/vs1.png" alt=""></span>
                                                    <span class="match-time"> 02 июня, 17:00 </span>
                                                </div>
                                                <div class="team-2-wrap dc">
                                                    <span class="team-img team-img-featurue"><img src="img/bb.png" alt=""></span>
                                                    <span class="team-name team-name-featurue">Planet Odd</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                
                                <?php 
                                if(empty($this->params['ShowStreamWidget'])){
                                   echo TwitchStreamsWidget::widget();
                                }
                                ?>
                            </aside>
                        </div> 
                        <!--CСАЙДБАР-->
                    </div>

                </div>
            </div>


            <?= $this->render('_elements/footer'); ?>

            <?php if (Yii::$app->user->isGuest): ?>
                <?= $this->render('@app/modules/user/views/auth/login'); ?>
                <?= $this->render('@app/modules/user/views/auth/reg'); ?>
                <?= $this->render('@app/modules/user/views/auth/send-email'); ?>
            <?php endif; ?>


        </div>
        <img class="nk-page-background-top" src="/img/site/top-bg2.png" alt="">
        <img class="nk-page-background-bottom" src="/img/site/bg-bottom.png" alt="">
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
