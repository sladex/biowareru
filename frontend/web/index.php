<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'prod');

require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
require(__DIR__ . '/../../common/config/aliases.php');

$config = yii\helpers\ArrayHelper::merge(
    //require(__DIR__ . '/../../vendor/sonicgd/bioengine/frontend/config/main.php'),
    require(__DIR__ . '/../../common/config/main.php'),
    require(__DIR__ . '/../config/main.php')
);

$application = new \bioengine\common\BioEngine($config);
require(__DIR__ . '/../../vendor/sonicgd/bioengine/common/config/ipbwi.config.php');
$application->run();
