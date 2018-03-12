<?php

namespace app\assets;

use yii\web\AssetBundle;
use Yii;

/**
 * Description of BackAsset
 *
 * @author pavel
 */
class BackAsset extends AssetBundle {
    
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        
        /*BASE STYLES*/
        'backend/assets/vendors/base/vendors.bundle.css',
        'backend/assets/demo/default/base/style.bundle.css',
        'backend/assets/css/back.css',
        /*VENDOR STYLES*/
        
    ];
    public $js = [
        
        /*BASE SCRIPTS*/
        'backend/assets/demo/default/base/scripts.bundle.js',
        

    ];

    public $depends = [
        'yii\web\YiiAsset'
    ];

    

}
