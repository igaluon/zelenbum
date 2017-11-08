<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'name' => 'Зеленбум',
//    'language'=>'ru-RU',
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
            'loginUrl' => '/admin/login',
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
//                '<lang:' . app\languages\LanguageKsl::$url_language . '>' => 'site/index',
                '<lang:(ru|uk|en)?>' => 'site/index',
                '<lang:(ru|uk|en)?>/<action:(product)>/<name:[\w\-]+>' => 'site/<action>',
                '<lang:(ru|uk|en)?>/<action:(our-works|contacts)>' => 'site/<action>',
                '<lang:(ru|uk|en)?>/<controller:(cart)>/<action:(list|order|update|remove)>' => '<controller>/<action>',
                'admin' => 'admin/product',
                'admin/logout' => 'admin/admin/logout',
                '/admin/login' => 'admin/admin/login',
                '<controller:(admin|seo|image)>/<action:(\w+?)>' => '<controller>/<action>',

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
