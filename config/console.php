<?php

use app\common\i18n\Formatter;
use yii\helpers\ArrayHelper;

$params       = require __DIR__ . '/params.php';
$db           = require __DIR__ . '/db.php';
$config_local = require __DIR__ . '/console-local.php';

$config = ArrayHelper::merge([
	'id'                  => 'basic-console',
	'basePath'            => dirname(__DIR__),
	'bootstrap'           => ['log'],
	'controllerNamespace' => 'app\commands',
	'aliases'             => [
		'@bower' => '@vendor/bower-asset',
		'@npm'   => '@vendor/npm-asset',
		'@tests' => '@app/tests',
	],
	'components'          => [
		'cache'     => [
			'class' => 'yii\caching\FileCache',
		],
		'log'       => [
			'targets' => [
				[
					'class'  => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db'        => $db,
		'formatter' => [
			'class' => Formatter::class,
		],
	],
	'params'              => $params,
], $config_local);

if (YII_ENV_DEV){
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][]    = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
	// configuration adjustments for 'dev' environment
	// requires version `2.1.21` of yii2-debug module
	$config['bootstrap'][]      = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		// uncomment the following to add your IP if you are not connecting from localhost.
		//'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
