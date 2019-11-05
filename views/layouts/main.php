<?php
use app\assets\{AppAsset, ImagesAsset};
use app\models\MenuItems;
use yii\bootstrap4\{Breadcrumbs, Html, Nav, NavBar};
use yii\helpers\Url;

AppAsset::register($this);
ImagesAsset::register($this);

$this->beginPage();

echo Html::beginTag('!DOCTYPE', ['html' => true]);
?>
<html lang="<?= Yii::$app->language ?>">
<head><?php
echo Html::tag('title', Html::encode($this->title));
$this->registerMetaTag(['charset' => Yii::$app->charset]);
$this->registerMetaTag(['name' => 'author', 'content' => Yii::$app->name]);
$this->registerMetaTag(['name' => 'description', 'content' => Html::encode(Yii::t('general', 'A music project'))]);
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1']);
$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::current([], true)]);
$this->registerLinkTag(['rel' => 'icon', 'sizes' => '16x16 32x32 48x48 64x64', 'type' => 'image/x-icon', 'href' => Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/favicon.ico']);
$this->registerCsrfMetaTags();
$this->head();
echo '</head><body>';

$this->beginBody();
echo Html::beginTag('header', ['class' => 'site-header fixed-top']);
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-dark bg-dark navbar-expand-md',
        ],
        'screenReaderToggleText' => Yii::t('general', 'Toggle navigation'),
    ]);

    if (Yii::$app->controller->id !== 'site' || Yii::$app->controller->action->id !== 'offline') {
        echo Nav::widget([
            'activateParents' => true,
            'encodeLabels' => false,
            'items' => MenuItems::menuArray(),
            'options' => ['class' => 'navbar-nav ml-auto'],
        ]);
    }

    NavBar::end();
echo Html::endTag('header');

echo '111';

echo Html::tag('main',
    Breadcrumbs::widget([
        'homeLink' => ['label' => Yii::$app->name, 'url' => Yii::$app->homeUrl],
        'links' => $this->params['breadcrumbs'] ?? [],
    ]) .
    $content
, ['class' => 'container position-relative']);

echo Html::beginTag('footer', ['class' => 'fixed-bottom']);
    echo Html::beginTag('div', ['class' => 'container']);
        echo Html::tag('span', '&copy; 2017-' . date('Y') . ' ' . Yii::$app->name);
        echo Html::tag('span', '&nbsp;', ['class' => 'float-right']);
    echo Html::endTag('div');
echo Html::endTag('footer');
$this->endBody();

echo '</body></html>';
$this->endPage();
