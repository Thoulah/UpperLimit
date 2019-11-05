<?php
$secrets = require(__DIR__ . '/secrets.php');

return [
    'aliases' => [
        '@assets' => '//s.upperlimit.eu',
        '@assetsroot' => __DIR__ . '/webassets',
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@siteDE' => 'http://www.upperlimit.de',
        '@siteEN' => 'http://www.upperlimit.eu',
    ],
    'basePath' => __DIR__,
    'bootstrap' => ['log'],
    'components' => [
        'assetManager' => [
            'basePath' => '@assetsroot',
            'baseUrl' => '@assets',
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'css' => [],
                ],
                'yii\bootstrap4\BootstrapPluginAsset' => [
                    'js' => [YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js'],
                ],
                'yii\web\JqueryAsset' => [
                    'js' => [YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'],
                ],
            ],
            'linkAssets' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\DbCache',
        ],
        'fileCache' => [
            'class' => 'yii\caching\FileCache',
            'directoryLevel' => 0,
        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
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
        'icon' => [
            'class' => 'thoulah\fontawesome\IconComponent',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'except' => ['yii\web\HttpException:404'],
                    'levels' => ['error'],
                    'logFile' => '@runtime/logs/error.log',
                ], [
                    'class' => 'yii\log\FileTarget',
                    'categories' => ['yii\web\HttpException:404'],
                    'levels' => ['error', 'warning'],
                    'logFile' => '@runtime/logs/404.log',
                ],
            ],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'normalizer' => [
                'class' => 'yii\web\UrlNormalizer',
            ],
            'showScriptName' => false,
            'rules' => [
                ''					=> 'site/index',
                'favicon.ico'                           => 'site/faviconico',
                'robots.txt'				=> 'site/robotstxt',
                'sitemap.xml'				=> 'site/sitemapxml',
                '<alias:\w+>'				=> 'site/<alias>',
            ],
        ],
    ],
    'name' => 'Upper Limit',
    'params' => require(__DIR__ . '/params.php'),
    'runtimePath' => __DIR__ . '/../../.cache/yii/upperlimit',
    'timeZone' => 'Europe/Berlin',
];
