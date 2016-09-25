<?php
use yii\bootstrap\Alert;
use yii\bootstrap\Html;

$this->title = $name;

echo Html::tag('h1', Html::encode($this->title));

echo Alert::widget(['options' => ['class' => 'alert-danger'], 'body' => nl2br(Html::encode($message)), 'closeButton' => false]);

echo Html::tag('p', Yii::t('general', 'The above error occurred while the Web server was processing your request.'));
