<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'name' => 'Media-Share',
    'timeZone' => 'Europe/Berlin',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@webUrl' => 'https://share.kellerkind24.de',
        '@uploadPath' => '/var/www/html/screenshots/uploads/'
    ],
    'components' => [
        'opengraph' => [
            'class' => 'umanskyi31\opengraph\OpenGraph',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '86l57wDbsx0qzcaWSxEi6UPgjKdHmty4',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\Users',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                's/<id:>' => 'screen/show',
                'd/<id:>' => 'screen/direct',
                'r/<id:>' => 'screen/delete',
                'privacy/<id:>' => 'screen/privacy-toggle',
                'profile/<id:>' => 'user/profile',
                'account' => 'site/account',
                'uploads' => 'screen/uploaded',
                'create' => 'screen/upload',
                'login' => 'site/login',
                'register' => 'site/register',
                'privacy-mass/<private:>' => 'site/account-privacy-mass',
                'delete-mass' => 'site/account-delete-content',
            ],
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
        //'allowedIPs' => ['*'],
    ];
}

return $config;
