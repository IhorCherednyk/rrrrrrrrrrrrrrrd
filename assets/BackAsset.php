<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Description of BackAsset
 *
 * @author pavel
 */
class BackAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        /* Begin global mandatory styles */
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic',
        'back/assets/css/bootstrap.min.css',
        'back/assets/css/bootstrap-extend.min.css',
        'back/assets/css/site.min.css',
        'back/assets/vendor/animsition/animsition.css',
        'back/assets/vendor/asscrollable/asScrollable.css',
        'back/assets/vendor/switchery/switchery.css',
        'back/assets/vendor/intro-js/introjs.css',
        'back/assets/vendor/slidepanel/slidePanel.css',
        'back/assets/vendor/flag-icon-css/flag-icon.css',
        /* Fonts */
        'back/assets/fonts/web-icons/web-icons.min.css',
        'back/assets/fonts/brand-icons/brand-icons.min.css',
            /* End fonts styles */
    ];
    public $js = [
        'back/assets/vendor/bootstrap/bootstrap.min.js',
        'back/assets/vendor/animsition/jquery.animsition.min.js',
        'back/assets/vendor/asscroll/jquery-asScroll.js',
        'back/assets/vendor/mousewheel/jquery.mousewheel.js',
        'back/assets/vendor/asscrollable/jquery.asScrollable.all.js',
        'back/assets/vendor/ashoverscroll/jquery-asHoverScroll.js',
        'back/assets/vendor/switchery/switchery.min.js',
        'back/assets/vendor/intro-js/intro.js',
        'back/assets/vendor/screenfull/screenfull.js',
        'back/assets/vendor/slidepanel/jquery-slidePanel.js',
        'back/assets/js/core.js',
        'back/assets/js/site.js',
        'back/assets/js/sections/menu.js',
        'back/assets/js/sections/menubar.js',
        'back/assets/js/sections/gridmenu.js',
        'back/assets/js/sections/sidebar.js',
        'back/assets/js/configs/config-tour.js',
        'back/assets/js/components/asscrollable.js',
        'back/assets/js/components/animsition.js',
        'back/assets/js/components/slidepanel.js',
//        'back/assets/js/components/switchery.js',
        'lt IE 9' => [
            'back/assets/vendor/html5shiv/html5shiv.min.js',
        ],
        'lt IE 10' => [
            'back/assets/vendor/media-match/media.match.min.js',
            'back/assets/vendor/respond/respond.min.js',
        ],
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
