<?php
use yii\bootstrap4\Html;

$this->title = Yii::t('site/music', 'Music');
$this->params['breadcrumbs'][] = $this->title;

echo Html::tag('div', 
	Html::tag('h1', $this->title, ['class' => 'text-center']) .
	Html::tag('iframe', Html::a('Hydrogen by Page 42', 'https://upperlimit.bandcamp.com/album/hydrogen'), [
		'src' => '//bandcamp.com/EmbeddedPlayer/album=3322856740/size=large/bgcol=ffffff/linkcol=337ab7/artwork=small/transparent=true/',
		'seamless' => true,
		'style' => 'border:0;height:241px;width:400px'
	])
, ['class' => 'intro']);
