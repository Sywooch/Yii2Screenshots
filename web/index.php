<?php

// comment out the following two lines when deployed to production
define('YII_DEBUG', true);
define('YII_ENV', 'prod');

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
