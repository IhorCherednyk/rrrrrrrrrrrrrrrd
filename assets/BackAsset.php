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
        'back/assets/plugins/font-awesome/css/font-awesome.min.css',
        'back/assets/plugins/bootstrap/css/bootstrap.min.css',
        'back/assets/plugins/uniform/css/uniform.default.css',
        'back/assets/plugins/select2/select2.css',
        'back/assets/plugins/select2/select2-metronic.css',
        'back/assets/plugins/data-tables/DT_bootstrap.css',
        'back/assets/plugins/bootstrap-datepicker/css/datepicker.css',
        'back/assets/plugins/bootstrap-datetimepicker/css/datetimepicker.css',
        'back/assets/plugins/bootstrap-colorpicker/css/colorpicker.css',
        
        'back/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css',
        
        'back/assets/css/custom.css',


        /* End global mandatory styles */
        /* Begin theme styles */
        'back/assets/css/style-metronic.css',
        'back/assets/css/style.css',
        'back/assets/css/style-responsive.css',
        'back/assets/css/plugins.css',
        'back/assets/css/themes/default.css',
        /* End theme styles */
    ];
    public $js = [
        'back/assets/plugins/bootstrap/js/bootstrap.min.js',
        'back/assets/plugins/animistion/jquery.animsition.js',
        'back/assets/plugins/animistion/jquery.animsition.js',
        'back/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'back/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'back/assets/plugins/jquery.blockui.min.js',
        'back/assets/plugins/jquery.cokie.min.js',
        'back/assets/plugins/uniform/jquery.uniform.min.js',
        'back/assets/plugins/jquery-validation/dist/jquery.validate.min.js',
        'back/assets/plugins/select2/select2.min.js',
        'back/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js',
        'back/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
        'back/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js',
        
        'back/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js',
        'back/assets/plugins/jquery.sortable.min.js',

        'back/assets/scripts/core/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
    ];

}
