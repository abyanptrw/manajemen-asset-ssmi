<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
        ],
        'gii' => [
        'class' => 'yii\gii\Module',
        // opsional: izinkan semua IP mengakses (untuk localhost biasanya aman)
        'allowedIPs' => ['*'],
    ],
],

    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'enableSession' => true,
            'loginUrl' => ['site/login'],
        ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            'report/usage' => 'report/usage',
            'asset-replacement' => 'site/asset-replacement',
            'report/replacement' => 'report/replacement',
            'report/checked-out' => 'report/checked-out',
            'site/delete/<id:\d+>' => 'site/delete',
        ],
    ],
],

    'params' => $params,
];
