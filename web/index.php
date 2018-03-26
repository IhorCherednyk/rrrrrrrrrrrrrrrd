<?php
// comment out the following two lines when deployed to production
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
function D($data, $isDie = TRUE) {
    $caller = array_shift(debug_backtrace(1));
    echo '<code>File: ' . $caller['file'] . ' / Line: ' . $caller['line'] . '</code>';
    echo '<pre>';
    \yii\helpers\VarDumper::dump($data, 10, true);
    echo '</pre>';
    if ($isDie)
        die();
}

function DD($data, $isDie = TRUE) {
    echo '<pre>';
    yii\helpers\VarDumper::dump($data);

    if ($isDie)
        die();
}
