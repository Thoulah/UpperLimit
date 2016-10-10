<?php
use yii\bootstrap\Html;

$this->title = Yii::$app->name;
?>
<div class="intro">
	<h1 class="text-center"><?= Yii::t('site/index', 'Welcome to {0}!', ['0' => Yii::$app->name]) ?></h1>

	<p class="lead"><?= Yii::t('site/index', 'This website is not ready yet. Please come back later.') ?></p>

	<?= Html::img(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/logo.svg') ?>
</div>
