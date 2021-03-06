<?php
namespace app\models\site;
use Yii;
use yii\base\Model;

class Contact extends Model {
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	public function rules() {
		return [
			[['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
			['email', 'email'],
			['verifyCode', 'captcha'],
		];
	}

	public function attributeLabels() {
		return [
			'name' => Yii::t('user', 'Name'),
			'email' => Yii::t('user', 'Email'),
			'subject' => Yii::t('general', 'Subject'),
			'body' => Yii::t('general', 'Message'),
			'verifyCode' => Yii::t('general', 'Verification Code'),
		];
	}

	public function contact() {
		if ($this->validate()) {
			return Yii::$app->mailer->compose()
				->setTo(Yii::$app->params['adminEmail'])
				->setFrom([$this->email => $this->name])
				->setSubject($this->subject)
				->setTextBody($this->body)
				->send();
		}
		return false;
	}
}
