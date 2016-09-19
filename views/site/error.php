<?php
use yii\bootstrap\Html;

$this->title = $name;

echo Html::tag('h1', Html::encode($this->title));
?>
<div class="alert alert-danger"><?= nl2br(Html::encode($message)) ?></div>

<p><?= Yii::t('general', 'The above error occurred while the Web server was processing your request.') ?></p>
