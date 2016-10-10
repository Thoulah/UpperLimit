<?php
namespace app\assets;
use Yii;

class AppAsset extends \yii\web\AssetBundle {
	public $sourcePath = '@app/assets/src/css';

	public $css = [
		'site.scss',
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
