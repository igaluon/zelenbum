<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Зеленбум',
    'language'=>'ru',
    'basePath' => dirname(__DIR__),
    'bootstrap' => [
        'seo',
        'log',
    ],
    'defaultRoute' => 'site/index',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
//        'seo' => [
//            'class' => \notgosu\yii2\modules\metaTag\Module::className(),
//        ],
        'seo' => [
            'class' => 'aquy\seo\module\Meta'
        ],
    ],
    'components' => [
//        'i18n' => [
//            'translations' => [
//                'app*' => [
//                    'class' => 'yii\i18n\PhpMessageSource',
//                    //'basePath' => '@app/messages',
//                    'sourceLanguage' => 'ru',
////                    'fileMap' => [
////                        'app'       => 'app.php',
////                        'app/error' => 'error.php',
////                    ],
//                ],
//            ],
//        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dBjBzMTsoFsUtpIF4GAaAqtGVC3hjCfo',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => '/web/admin/admin/login',
        ],
        'cart' => [
            'class' => 'yz\shoppingcart\ShoppingCart',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath'         => '@app/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'gomail' => [
            'class' => 'app\component\GoMail',
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
        'seo' => [
            'class' => 'aquy\seo\components\Seo'
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'class' => 'app\component\UrlManager',
            'rules' => [
                
                '<controller:(site)>/<lang:\w+?>/<action:(index)>' => '<controller>/<action>',
                '<controller:(site)>/<lang:\w+?>/<action:(product|our-works|contacts)>' => '<controller>/<action>',
                '<controller:(cart)>/<lang:\w+>/<action:(list|order)>' => '<controller>/<action>',
                'admin/login' => 'admin/admin/login',
                'admin' => 'admin/product',
                'admin/logout' => 'admin/admin/logout',
                '<controller:(admin|seo)>/<action:(\w+?)>' => '<controller>/<action>',

//                '<controller:(site|product)>/<lang:\w+>/<action:(index|update|delete)>' => '<controller>/<action>',
//              'web/.<language: \w+>./site/product' => 'site/product',
//              'web/site/.<language: \w+>./product' => 'site/<language>/product',
//                'http://<language:\w+>.example.com/posts' => 'post/index,
//                '<lang:' . app\languages\LanguageKsl::$url_language . '>/page-<page:\d+>/' => 'post/index',
//                '<lang:' . app\languages\LanguageKsl::$url_language . '>/' => 'post/index',
//
//                [
//                    'pattern'=> '<lang:' . app\languages\LanguageKsl::$url_language . '>/<url\w+>',
//                    'route' => 'site/index',
//                    'suffix' => '.php',
//                ],
//                '<lang:' . app\languages\LanguageKsl::$url_language . '>/<action:(contact|index|logout|language|about|signup)>' => 'site/<action>',
            ]
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function () {
            (new app\languages\LanguageKsl())->run();
        },
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
