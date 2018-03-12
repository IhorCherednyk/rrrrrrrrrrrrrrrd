<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');
\Yii::setAlias('@img', '/img');

$params['admin.grid.tableOptions'] = [
    'class' => 'table table-bordered table-hover table-striped m-table--head-bg-success'
];
$params['admin.grid.options'] = [
    'class' => 'grid-view table-responsive'
];
$params['admin.grid.headerRowOptions'] = [
    'class' => ''
];

//FORM OPTIONS
$params['admin.form.fieldConfig'] = [
    'options' => [
        'class' => 'm-form m-form--fit m-form--label-align-right m-form--state',
    ],
    'errorCssClass' => 'has-danger',
    'fieldConfig' => [
        'options' => [
            'class' => 'form-group m-form__group',
        ],
        'template' => "{label}{input}{error}",
        'inputOptions' => [
            'class' => 'form-control m-input',
        ],
        'errorOptions' => [
            'class' => 'help-block form-control-feedback',
        ],
    ],
];
$params['admin.grid.pager'] = [
    'firstPageLabel' => Yii::t('app', 'First Page'),
    'lastPageLabel' => Yii::t('app', 'Last Page'),
];

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'defaultRoute' => 'site/about',
    'timeZone' => 'Europe/Kiev',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'nveD3wtkQMFd4sHt2C5YJVG9DH_Ahbdq',
            'baseUrl' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager',
            'defaultRoles' => ['admin', 'USER'],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'd MMMM, H:mm',
            'locale' => 'ru_RU'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['/user/auth/login']
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                'db' => [
                    'class' => 'yii\log\DbTarget',
                    'levels' => ['warning'],
                    'categories' => ['profile','steam'], // Если не указывать 'categories', то по умолчанию значение будет равно 'application' и к нашим сообщения будут добавлены многие другие. Например, подключение и запросы к базе данных.
                    'logVars' => [] // не пишет данные из переменных $_GET, $_POST, $_FILES, $_COOKIE, $_SESSION и $_SERVER.
                ],
            ],
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin' => 'pages/pages-back/index',
                'booklist' => 'bookmekers/bookmeker/book-list',
                'team' => 'team/team/index',
                'streams' => 'streams/stream/index',
                'forecasts' => 'forecasts/forecast/index',
                '<slug>' => 'pages/pages/show'
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'sourcePath' => null,
                    'js' => []
                ],
            ],
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
        'pages' => [
            'class' => 'app\modules\pages\Module',
        ],
        'bookmekers' => [
            'class' => 'app\modules\bookmekers\Module',
        ],
        'team' => [
            'class' => 'app\modules\team\Module',
        ],
        'streams' => [
            'class' => 'app\modules\streams\Module',
        ],
        'forecasts' => [
            'class' => 'app\modules\forecasts\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
            // uncomment the following to add your IP if you are not connecting from localhost.
            //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
