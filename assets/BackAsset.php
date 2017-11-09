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
        /*stylesheet*/
        
        'back/css/bootstrap.min.css',
        'back/css/bootstrap-extend.min.css',
        'back/css/site.min.css',
        'back/css/custom.css',
        
        /*plugins*/
        'back/vendor/animsition/animsition.css',
        'back/vendor/asscrollable/asScrollable.css',
        'back/vendor/switchery/switchery.css',
        'back/vendor/intro-js/introjs.css',
        'back/vendor/slidepanel/slidePanel.css',
        'back/vendor/flag-icon-css/flag-icon.css',
        
        /*fonts*/
        'back/fonts/web-icons/web-icons.min.css',
        'back/fonts/brand-icons/brand-icons.min.css',
        'back/vendor/select2/select2.min.css',
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic',
    ];
    public $js = [
        /*Core*/
        'back/vendor/bootstrap/bootstrap.min.js',
        'back/vendor/animsition/jquery.animsition.js',
        'back/vendor/asscroll/jquery-asScroll.js',
        'back/vendor/mousewheel/jquery.mousewheel.js',
        'back/vendor/asscrollable/jquery.asScrollable.all.js',
        'back/vendor/ashoverscroll/jquery-asHoverScroll.js',
        
        /*Plugins*/
        'back/vendor/intro-js/intro.js',
        'back/vendor/slidepanel/jquery-slidePanel.js',
        'back/vendor/select2/select2.full.min.js',
        
        
        /*Scripts*/
        
        'back/js/core.js',
        'back/js/site.js',
        
        'back/js/sections/menu.js',
        'back/js/sections/menubar.js',
        'back/js/sections/gridmenu.js',
        'back/js/sections/sidebar.js',
        
        
        'back/js/configs/config-colors.js',
        'back/js/configs/config-tour.js',
        
        
        'back/js/components/asscrollable.js',
        'back/js/components/animsition.js',
        'back/js/components/slidepanel.js',
        'back/js/components/switchery.js',
        
        
        'lt IE 9' => [
            'back/vendor/html5shiv/html5shiv.min.js',
         ],
        'lt IE 10' => [
            'back/vendor/media-match/media.match.min.js',
            'back/vendor/respond/respond.min.js',
         ],

    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
