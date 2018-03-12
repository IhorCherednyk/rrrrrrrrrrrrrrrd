<?php

use app\modules\user\models\User;
use yii\widgets\Menu;

$subitemLinkTemplate = '<a class="m-menu__link m-menu__toggle" href="{url}">{icon}<span class="m-menu__link-text">{label}</span>{arrow}</a>';
$linkTemplate = '<a class="m-menu__link" href="{url}">{icon}<span class="m-menu__link-text">{label}</span></a>';
?><!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>

<div id="m_aside_left" class="m-grid__item m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div 
        id="m_ver_menu" 
        class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
        data-menu-vertical="true"
        data-menu-scrollable="false" data-menu-dropdown-timeout="500"  
        >

        <?=
        Menu::widget([
            'encodeLabels' => false,
            'activeCssClass' => 'm-menu__item--active',
            'activateParents' => true,
            'submenuTemplate' => "\n<div class=\"m-menu__submenu\">\n<span class=\"m-menu__arrow\"></span>\n<ul class=\"m-menu__subnav\">{items}\n</ul>\n</div>\n",
            'options' => [
                'class' => 'm-menu__nav m-menu__nav--dropdown-submenu-arrow'
            ],
            'itemOptions' => [
                'class' => 'm-menu__item',
                'aria-haspopup' => 'true'
            ],
            'items' => [
                    [
                    'label' => Yii::t('app', 'Pages'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/pages/pages-back/index'],
                ],
                    [
                    'label' => Yii::t('app', 'Bookmekers'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/bookmekers/bookmeker-back/index'],
                ],
                    [
                    'label' => Yii::t('app', 'Teams'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/team/team-back/index'],
                ],
                    [
                    'label' => Yii::t('app', 'Matches'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/forecasts/matches-back/index'],
                ],
                    [
                    'label' => Yii::t('app', 'Forecasts'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/forecasts/forecast-back/index'],
                ],
                    [
                    'label' => Yii::t('app', 'Users'),
                    'template' => strtr($linkTemplate, ['{icon}' => '<i class="m-menu__link-icon flaticon-line-graph"></i>']),
                    'url' => ['/user/user-back/index'],
                ]
            ]
        ]);
        ?>

    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->