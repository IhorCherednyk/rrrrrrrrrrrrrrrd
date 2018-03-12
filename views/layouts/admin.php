<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\BackAsset;
use yii\widgets\Menu;

BackAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="bootstrap admin template">
        <meta name="author" content="">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,500i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">


    </head>
    <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
        <?php $this->beginBody() ?>
        <!-- begin:: Page -->
        <div class="m-grid m-grid--hor m-grid--root m-page">



            <!-- begin: Header -->
            <?= $this->render('_elements/back/header'); ?>    
            <!-- END: Header -->	




            <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

                <!--MENU:START-->

                <?= $this->render('_elements/back/menu'); ?>

                <!--MENU:END-->

                <div class="m-grid__item m-grid__item--fluid m-wrapper">
                    <!-- BEGIN: Subheader -->
                    <div class="m-subheader ">

                        <?php if (Yii::$app->session->getFlash('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?= Html::tag('strong', Yii::$app->session->getFlash('success')) ?>
                            </div>
                        <?php endif; ?>

                        <?php if (Yii::$app->session->getFlash('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= Html::tag('error', Yii::$app->session->getFlash('error')) ?>
                            </div>
                        <?php endif; ?>


                        <div class="d-flex align-items-center">

                            <div class="mr-auto">

                                <?php if ($this->context->module->id != 'dashboard'): ?>

                                    <h3 class="m-subheader__title m-subheader__title--separator"><?= Html::encode($this->title) ?></h3>

                                    <?php
                                    echo Breadcrumbs::widget([
                                        'itemTemplate' => "<li class=\"m-nav__separator\">-</li><li class=\"m-nav__item\">{link}</li>\n", // template for all links
                                        'options' => [
                                            'class' => 'm-subheader__breadcrumbs m-nav m-nav--inline'
                                        ],
                                        'homeLink' => [
                                            'label' => '<i class="m-nav__link-icon la la-home"></i>',
                                            'url' => '/admin/dashboard',
                                            'template' => "<li class=\"m-nav__item m-nav__item--home\">{link}</li>\n", // template for this link only
                                            'encode' => false,
                                            'class' => 'm-nav__link m-nav__link--icon'
                                        ],
                                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                    ]);
                                    ?>
                                <?php else: ?>
                                    <h3 class="m-subheader__title"><?= Html::encode($this->title) ?></h3>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <!-- END: Subheader -->

                    <div class="m-content">
                        <div class="m-portlet m-portlet--mobile <?= ($this->context->module->id != 'dashboard') ? '' : 'dashboard' ?>">

                            <?= $content ?>
                        </div>
                    </div>

                </div>


            </div>



            <!-- begin::Footer -->
            <?= $this->render('_elements/back/footer'); ?>
            <!-- end::Footer -->



        </div>
        <!-- end:: Page -->















        <script src="/backend/assets/vendors/base/vendors.bundle.js"></script>

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>