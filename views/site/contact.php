<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = Yii::t('site/contact', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
	<h1><?= Html::encode($this->title) ?></h1>

	<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

		<div class="alert alert-success">
			<?= Yii::t('site/contact', 'Thank you for contacting {0}. We will respond to you as soon as possible.', ['0' => Yii::$app->name]) ?>
		</div>

	<?php else: ?>

		<div class="row">
			<div class="col-lg-5">

				<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

					<?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

					<?= $form->field($model, 'email') ?>

					<?= $form->field($model, 'subject') ?>

					<?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>

					<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
						'imageOptions' => ['alt' => 'CAPTCHA image', 'class' => 'captcha'],
						'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
					]) ?>

					<div class="form-group">
						<?= Html::submitButton(Yii::t('general', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
					</div>

				<?php ActiveForm::end(); ?>

			</div>
		</div>

	<?php endif; ?>
</div>
