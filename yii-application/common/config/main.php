<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
                'class' => 'yii\rbac\DbManager',
                // uncomment if you want to cache RBAC items hierarchy
                // 'cache' => 'cache',
        ],

        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'urlManager'=>[
            'enablePrettyUrl'=>true,
            'showScriptName'=>false,
            'rules'=>[
                [
                    'class'=>'yii\rest\UrlRule',
                    'controller'=>'api/user',
                    'extraPatterns'=>[
                        'POST signup'=>'signup',
                        'POST login'=>'login'
                    ]
                ]
            ]
        ]

    ],
];
