<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\MenuItems;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<?= Html::tag('title', Html::encode($this->title)) ?>
<?= $this->registerMetaTag(['charset' => Yii::$app->charset]) ?>
<?= $this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]) ?>
<?= $this->registerMetaTag(['name' => 'description', 'content' => Html::encode(Yii::$app->params['description'])]) ?>
<?= $this->registerMetaTag(['name' => 'robots', 'content' => 'noindex']) ?>
<?= $this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']) ?>
<?= $this->registerLinkTag(['rel' => 'canonical', 'href' => Url::to(Url::current(), true)]) ?>
<?= $this->registerLinkTag(['rel' => 'icon', 'sizes' => '16x16 32x32 48x48 64x64', 'type' => 'image/x-icon', 'href' => Url::to('@assetsUrl/images/'.Yii::$app->params['favicon'])]) ?>
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
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => MenuItems::menuArray(),
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= date('Y') ?> <?= Yii::$app->name ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
