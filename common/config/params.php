<?php
defined('BW_ROOT') or define('BW_ROOT', realpath(__DIR__ . '/../../'));
$config = [
    'db'                     => require_once('db.php'),
    'site_url'               => 'http://bw.localhost.ru',
    'admin_url'              => 'http://admin.bioware.ru',
    'site_path'              => '/var/www/bioware/bioware.ru/www',
    'files_path'             => '/var/www/bioware/bioware.ru/files',
    'files_url'              => 'http://files.bioware.ru',
    'assets_url'             => 'http://assets.bioware.ru',
    'images_path'            => '/var/www/bioware/bioware.ru/images',
    'images_url'             => 'http://images.bioware.ru',
    'uploads_url'            => 'http://uploads.bioware.ru',
    'games_images_url'       => '/images/games/',
    'developers_images_url'  => '/images/developers/',
    'topics_images_url'      => '/images/topics/',
    'games_images_path'      => BW_ROOT . DIRECTORY_SEPARATOR . 'frontend/web/images/games/',
    'developers_images_path' => BW_ROOT . DIRECTORY_SEPARATOR . 'frontend/web/images/developers/',
    'topics_images_path'     => BW_ROOT . DIRECTORY_SEPARATOR . 'frontend/web/images/topics/',
    'ipbwi_BOARD_PATH'       => BW_ROOT . DIRECTORY_SEPARATOR . 'frontend/web/forum/',
    'ipbwi_ROOT_PATH'        => BW_ROOT . DIRECTORY_SEPARATOR . 'vendor/haslv/ipbwi/src/vendor/ipbwi/',
    'ipbwi_WEB_URL'          => 'http://bw.localhost.ru',
    'ipbwi_COOKIE_DOMAIN'    => '.bw.localhost.ru',
    'components.redis'       => [
        'class'    => \yii\redis\Connection::className(),
        'hostname' => 'localhost',
        'port'     => 6379,
        'database' => 5
    ],
    'components.redis_dev'   => [
        'class'    => \yii\redis\Connection::className(),
        'hostname' => 'localhost',
        'port'     => 6379,
        'database' => 6
    ],
    'components.redis_test'  => [
        'class'    => \yii\redis\Connection::className(),
        'hostname' => 'localhost',
        'port'     => 6379,
        'database' => 7
    ],
    'components.cache'       => [
        'class'     => \yii\redis\Cache::className(),
        'keyPrefix' => 'cgcache',
    ]
];

if (file_exists(__DIR__ . '/params.local.php')) {
    $config = array_merge(
        $config,
        require(__DIR__ . '/params.local.php')
    );
}
return $config;