<?php
use yii\helpers\Html;

$this->title = 'Offline';

echo Html::tag('h1', Html::encode($this->title));

echo Yii::t('ul-general', 'This website is temporarily offline for maintenance.');
