<?php
$this->title = $name;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="alert alert-danger">
	<?= nl2br(Html::encode($message)) ?>
</div>

<p><?= Yii::t('ul-general', 'The above error occurred while the Web server was processing your request.') ?></p>
