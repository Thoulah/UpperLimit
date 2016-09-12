<?php
$secrets = require(__DIR__ . '/secrets.php');

return [
	'aliases' => [
		'@app' => __DIR__,
		'@siteDE' => 'http://www.upperlimit.de',
		'@siteEN' => 'http://www.upperlimit.eu',
	],
	'basePath' => __DIR__,
	'bootstrap' => ['log'],
	'components' => [
		'assetManager' => [
			'basePath' => '@assetsPath',
			'baseUrl' => '@assetsUrl',
			'bundles' => [
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [],
				],
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => [YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
				],
				'yii\web\JqueryAsset' => [
					'js' => [YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'],
				],	
			],
			'converter' => [
				'class' => 'yii\web\AssetConverter',
			],
			'linkAssets' => true,
		],
		'cache' => [
			'class' => 'yii\caching\DbCache',
		],
		'fileCache' => [
			'class' => 'yii\caching\FileCache',
			'cacheFileSuffix' => '.ser',
			'directoryLevel' => 0,
		],
		'i18n' => [
			'translations' => [
				'ul-*' => [
					'class' => 'yii\i18n\PhpMessageSource',
				],
			],
		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host='.$secrets['MySQL']['host'].';dbname='.$secrets['MySQL']['db'],
			'username' => $secrets['MySQL']['user'],
			'password' => $secrets['MySQL']['pass'],
			'charset' => 'utf8',
			'tablePrefix' => 'upperlimit_',

			'enableSchemaCache' => true,
			'schemaCache' => 'fileCache',
			'schemaCacheDuration' => 60*60*24*7,

			'enableQueryCache' => true,
			'queryCache' => 'fileCache',
			'queryCacheDuration' => 60*60*24*2,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\DbTarget',
					'levels' => ['error', 'warning'],
					'logTable' => 'x_log',
				],
			],
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
		],
		'pdf' => [
			'class' => \kartik\mpdf\Pdf::classname(),
			'mode' => \kartik\mpdf\Pdf::MODE_UTF8,
		],
		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
				''																	=> 'site/index',
				'favicon.ico'													=> 'tech/faviconico',
				'robots.txt'													=> 'tech/robotstxt',
				'sitemap.xml'													=> 'tech/sitemapxml',
				'feed/rss'														=> 'tech/rss',
				'<alias:\w+>'													=> 'site/<alias>',
			],
		],
	],
	'name' => 'Upper Limit',
	'params' => require(__DIR__ . '/params.php'),
	'runtimePath' => __DIR__ . '/../yii-runtime/me.mr42.www',
	'timeZone' => 'Europe/Berlin',
	'vendorPath' => __DIR__ . '/../yii2/vendor',
];
