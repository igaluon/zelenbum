<?php
$params = require(__DIR__ . '/params.php');
$dbParams = require(__DIR__ . '/test_db.php');

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

/**
 * Application configuration shared by all test types
 */
return [
    'id' => 'basic-tests',
    'basePath' => dirname(__DIR__),    
    'language' => 'en-US',
    'components' => [
        'db' => $dbParams,
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'users' => [
            'identityClass' => 'app\modules\transfer\models\User',
            'class' => 'yii\web\User',
        ],
        'request' => [
            'cookieValidationKey' => 'test',
            'enableCsrfValidation' => false,
            // but if you absolutely need it set cookie domain to localhost
            /*
            'csrfCookie' => [
                'domain' => 'localhost',
            ],
            */
        ],        
    ],
    'params' => $params,
];
