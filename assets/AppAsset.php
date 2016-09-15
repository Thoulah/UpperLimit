<?php
namespace app\assets;
use Yii;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle
{
	public $sourcePath = '@app/assets/src';

	public $css = [
		'css/site.scss',
	];

	public $js = [
	];

	public $depends = [
 		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
	];

	public $publishOptions = [
		'forceCopy' => YII_ENV_DEV,
	];
}
