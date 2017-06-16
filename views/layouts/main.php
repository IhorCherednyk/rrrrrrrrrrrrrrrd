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

            <?= $this->render('_elements/header'); ?>


            <div class="main-content-wrapper">
                <div class="container">
                    <?php if (Yii::$app->session->getFlash('success')): ?>
                        <div class="nk-info-box text-success">
                            <div class="nk-info-box-icon">
                                <i class="fa fa-times" aria-hidden="true"></i>
                            </div>
                                <?= Html::tag('h3', Yii::$app->session->getFlash('success'))?>
                        </div>
                    <?php endif;?>
                    
                    <?php if (Yii::$app->session->getFlash('error')):?>
                        <div class="nk-info-box text-danger">
                            <div class="nk-info-box-icon">
                                <i class="fa fa-check" aria-hidden="true"></i>
                            </div>
                            <?= Html::tag('h3', Yii::$app->session->getFlash('error'))?>
                        </div>
                    <?php endif;?>
                    <?= $content ?>
                </div>
            </div>


            <?= $this->render('_elements/footer'); ?>

            <?php if (\Yii::$app->user->isGuest): ?>
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
