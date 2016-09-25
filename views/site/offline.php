<?php
use yii\helpers\Html;

$this->title = Yii::t('site/offline', 'Offline');

echo Html::tag('h1', Html::encode($this->title));

echo Yii::t('site/offline', 'This website is temporarily offline for maintenance.');
