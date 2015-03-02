<?php
 /**
 * 
 * bootstrap.php
 *
 * Date: 30/01/15
 * Time: 14:04
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');
Yii::setAlias('@tests', __DIR__);
new \yii\console\Application([
    'id' => 'testApp',
    'basePath' => __DIR__,
]);