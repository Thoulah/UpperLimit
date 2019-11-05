<?php
use yii\bootstrap4\Html;

$this->title = Yii::$app->name;

echo Html::tag('div', 
    Html::tag('h1', Yii::t('site/index', 'Welcome to {0}!', ['0' => Yii::$app->name]), ['class' => 'text-center']) .
    Html::tag('p', Yii::t('site/index', 'This website is not ready yet. Please come back later.'), ['class' => 'lead']) .
    Html::img(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/logo.svg')
, ['class' => 'intro']);
