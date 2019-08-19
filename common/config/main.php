<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=yii_2.0.11_new',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
        ],
    ],

    //手动加载vendor包
    'aliases'=>[
        '@bower'=>'@vendor/bower-asset',
        '@rmrevin/yii/fontawesome'=>'@vendor/rmrevin/yii2-fontawesome'
    ]
];
