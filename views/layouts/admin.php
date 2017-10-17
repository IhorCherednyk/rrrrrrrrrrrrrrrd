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
$this->registerJsFile('@web/back/vendor/modernizr/modernizr.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('@web/back/vendor/breakpoints/breakpoints.js', ['position' => \yii\web\View::POS_HEAD]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="bootstrap admin template">
        <meta name="author" content="">
        <?= Html::csrfMetaTags() ?>
        <title>Menu Expended | Remark Admin Template</title>



        <?php $this->head() ?>
    </head>
    <script>
        Breakpoints();
    </script>
    <body class="site-menubar-unfold" data-auto-menubar="false">
        <?php $this->beginBody() ?>




        <nav class="site-navbar navbar navbar-default navbar-fixed-top navbar-mega" role="navigation">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"
                        data-toggle="menubar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="hamburger-bar"></span>
                </button>
                <button type="button" class="navbar-toggle collapsed" data-target="#site-navbar-collapse"
                        data-toggle="collapse">
                    <i class="icon wb-more-horizontal" aria-hidden="true"></i>
                </button>
                <div class="navbar-brand navbar-brand-center site-gridmenu-toggle">
                    <span class="navbar-brand-text">Dota Prognoz</span>
                </div>

            </div>
            <div class="navbar-container container-fluid">
                <!-- Navbar Collapse -->
                <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                    <!-- Navbar Toolbar -->
                    <ul class="nav navbar-toolbar">
                        <li class="hidden-float" id="toggleMenubar">
                            <a data-toggle="menubar" href="#" role="button">
                                <i class="icon hamburger hamburger-arrow-left">
                                    <span class="sr-only">Toggle menubar</span>
                                    <span class="hamburger-bar"></span>
                                </i>
                            </a>
                        </li>

                    </ul>
                    <!-- End Navbar Toolbar -->

                </div>
                <!-- End Navbar Collapse -->

                <!-- Site Navbar Seach -->
                <div class="collapse navbar-search-overlap" id="site-navbar-search">
                    <form role="search">
                        <div class="form-group">
                            <div class="input-search">
                                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                                <input type="text" class="form-control" name="site-search" placeholder="Search...">
                                <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search"
                                        data-toggle="collapse" aria-label="Close"></button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Site Navbar Seach -->
            </div>
        </nav>





        <div class="site-menubar">
            <div class="site-menubar-body">
                <div>
                    <div>


                        <?=
                        Menu::widget([
                            'options' => [
                                'class' => 'site-menu',
                            ],
                            'activeCssClass' => 'active',
                            'encodeLabels' => false,
                            'activateParents' => true,
                            'submenuTemplate' => "\n<ul class=\"site-menu-sub\">\n{items}\n</ul>\n",
                            'items' => [
//                                    [
//                                    'label' => '<i class="site-menu-icon wb-layout" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Pages') . '</span><span class="site-menu-arrow"></span>',
//                                    'encode' => false,
//                                    'url' => 'javascript:void(0);',
//                                    'options' => ['class' => 'site-menu-item has-sub'],
//                                    'items' => [
//                                            [
//                                            'label' => '<i class="site-menu-icon" aria-hidden="true"></i><span class="site-menu-title">' .Yii::t('app', 'FAQ'). '</span>',
//                                            'url' => ['/pages/pages-back/index'],
//                                            'options' => ['class' => 'site-menu-item has-sub'],
//                                            
//                                        ],
//                                    ],
//                                ],
                                
                                [
                                'label' => '<i class="site-menu-icon wb-file" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Pages') . '</span>',
                                'url' => ['/pages/pages-back/index'],
                                'options' => ['class' => 'site-menu-item'], 
                                ],
                                [
                                'label' => '<i class="site-menu-icon wb-bookmark" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Bookmekers') . '</span>',
                                'url' => ['/bookmekers/bookmeker-back/index'],
                                'options' => ['class' => 'site-menu-item'], 
                                ],
                                [
                                'label' => '<i class="site-menu-icon wb-users" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Teams') . '</span>',
                                'url' => ['/team/team-back/index'],
                                'options' => ['class' => 'site-menu-item'], 
                                ],
                                [
                                'label' => '<i class="site-menu-icon wb-users" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Matches') . '</span>',
                                'url' => ['/forecasts/forecast-back/index'],
                                'options' => ['class' => 'site-menu-item'], 
                                ],
                                [
                                'label' => '<i class="site-menu-icon wb-users" aria-hidden="true"></i><span class="site-menu-title">' . Yii::t('app', 'Users') . '</span>',
                                'url' => ['/user/user-back/index'],
                                'options' => ['class' => 'site-menu-item'], 
                                ]
                            ],
                        ]);
                        ?>

                    </div>
                </div>
            </div>

            <div class="site-menubar-footer">
                <a href="javascript: void(0);" class="fold-show" data-placement="top" data-toggle="tooltip"
                   data-original-title="Settings">
                    <span class="icon wb-settings" aria-hidden="true"></span>
                </a>
                <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Lock">
                    <span class="icon wb-eye-close" aria-hidden="true"></span>
                </a>
                <a href="javascript: void(0);" data-placement="top" data-toggle="tooltip" data-original-title="Logout">
                    <span class="icon wb-power" aria-hidden="true"></span>
                </a>
            </div>
        </div>




        <!-- Page -->
        <div class="page animsition">

            <div class="page-content">
                <div class="panel">

                    <div class="panel-body">
                        <?= $content ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page -->






<?php $this->endBody() ?>
        <script>
            (function (document, window, $) {
                'use strict';

                var Site = window.Site;
                $(document).ready(function () {
                    Site.run();
                });
            })(document, window, jQuery);
        </script>
    </body>

</html>
<?php $this->endPage() ?>