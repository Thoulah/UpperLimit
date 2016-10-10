<?php
use app\assets\AppAsset;
use app\assets\ImagesAsset;
use app\models\MenuItems;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
ImagesAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= Html::tag('title', Html::encode($this->title)) ?>
<?= $this->registerMetaTag(['charset' => Yii::$app->charset]) ?>
<?= $this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]) ?>
<?= $this->registerMetaTag(['name' => 'description', 'content' => Html::encode(Yii::t('general', 'A music project'))]) ?>
<?= $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']) ?>
<?= $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::current([], true)]) ?>
<?= $this->registerLinkTag(['rel' => 'icon', 'sizes' => '16x16 32x32 48x48 64x64', 'type' => 'image/x-icon', 'href' => Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/favicon.ico']) ?>
<?= Html::csrfMetaTags() ?>
<?= $this->head() ?></head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
	<?php
	NavBar::begin([
		'brandLabel' => Yii::$app->name,
		'brandUrl' => Yii::$app->homeUrl,
		'options' => [
			'class' => 'navbar-inverse navbar-fixed-top',
		],
		'screenReaderToggleText' => Yii::t('general', 'Toggle navigation'),
	]);

	if (Yii::$app->controller->id !== 'site' || Yii::$app->controller->action->id !== 'offline') {
		echo Nav::widget([
			'encodeLabels' => false,
			'items' => MenuItems::menuArray(),
			'options' => ['class' => 'navbar-nav navbar-right'],
		]);
	}

	NavBar::end();
	?>

	<div class="container">
		<?= Breadcrumbs::widget([
			'homeLink' => ['label' => Yii::$app->name, 'url' => Yii::$app->homeUrl],
			'links' => $this->params['breadcrumbs'] ?? [],
		]) ?>
		<?= $content ?>
	</div>
</div>

<footer class="footer">
	<div class="container">
		<p class="pull-left">&copy; <?= date('Y') ?> <?= Yii::$app->name ?></p>
		<p class="pull-right"></p>
	</div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
