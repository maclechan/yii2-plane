<?php
return [
    'language' =>'zh-CN',//默认使用中文
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
           // 'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'suffix' => '.html',
            'rules' => [
                //'<controller:\w+>s' => '<controller>/index',
                //'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            //'tablePrefix' => ''
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        /*'urlManager' => [
            // here is your normal backend url manager config
        ],
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
            //BaseUrl => 'xxx',
            //HostInfo => 'yyy',
            使用前台的url echo Yii::$app->urlManagerFrontend->createUrl(...);
        ],*/

    ],
];
