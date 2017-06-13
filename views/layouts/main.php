<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\widgets\Menu;
use yii\bootstrap\Modal;

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

            <button id="register" data-toggle="modal" data-target="#my-modal" class="btn btn-primary">Register</button>

            <div class="main-content-wrapper">
                <div class="container">
                    <?= $content ?>
                </div>
            </div>


            <?= $this->render('_elements/footer') ?>


            <?php //$this->render('@app/modules/user/views/auth/login') ?>
            <?php //$this->render('@app/modules/user/views/auth/reg') ?>

        </div>
        <?php
        Modal::begin([
            'id' => 'my-modal',
        ]);
        ?>
        <?php
        Modal::end();
        ?>
        <img class="nk-page-background-top" src="/img/site/top-bg2.png" alt="">
        <img class="nk-page-background-bottom" src="/img/site/bg-bottom.png" alt="">
        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>
