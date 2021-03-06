<?php
/**
 * Created by PhpStorm.
 * User: Георгий
 * Date: 07.07.2014
 * Time: 11:37
 */

use biowareru\frontend\helpers\BioHtml;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/params.php')
);

return [
    'id'                  => 'app-frontend',
    'basePath'            => dirname(__DIR__),
    'bootstrap'           => ['log'],
    'controllerNamespace' => 'biowareru\frontend\controllers',
    'vendorPath'          => dirname(dirname(__DIR__)) . '/vendor',
    'layout'              => false,
    'components'          => [
        'user'         => [
            'identityClass'   => \bioengine\common\modules\ipb\models\IpbMember::class,
            'enableAutoLogin' => true
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning']
                ]
            ]
        ],
        'errorHandler' => [
            'errorAction' => 'site/error'
        ],
        'db'           => $params['db'],
        'request'      => [
            'class'               => \yii\web\Request::className(),
            'cookieValidationKey' => 'somesecretvalidationkey',
            'parsers'             => [
                'application/json' => 'yii\web\JsonParser'
            ]
        ],
        'view'         => [
            'renderers' => [
                'twig' => [
                    'class'     => \yii\twig\ViewRenderer::class,
                    // set cachePath to false in order to disable template caching
                    'cachePath' => '@runtime/Twig/cache',
                    // Array of twig options:
                    'options'   => [
                        'auto_reload' => true
                    ],
                    'globals'   => [
                        'production' => true,
                        'user'       => 'biowareru\frontend\helpers\UsersHelper',
                        'menu'       => 'biowareru\frontend\helpers\MenuHelper',
                        'slider'     => 'biowareru\frontend\helpers\SliderHelper',
                        'polls'      => 'biowareru\frontend\helpers\PollsHelper',
                        'html'       => '\yii\helpers\Html',
                        'bioHtml'    => BioHtml::class
                    ]
                    // ... see ViewRenderer for more options
                ]
            ]
        ]
    ],
    'params'              => $params
];