<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-agent',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'agent\controllers',
   // 'defaultRoute' => 'article',
    'bootstrap' => ['log'],
    'modules' => [
        'article' => [
            'class' => 'agent\modules\article\Module',
            'defaultRoute' => 'article/articlelist',
        ],
        'goods' =>[
             'class'=>'agent\modules\goods\module',
             'defaultRoute'=>'goods/list',
         ]
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\AgMerch',
            'enableAutoLogin' => true,
        ],
        //自定义图片上传类
        'imgload' => [
            'class' => 'agent\components\Upload'
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
