<?php
namespace app\models\site;
use Yii;
use yii\base\Model;

class Contact extends Model
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;

	public function rules()
	{
		return [
			[['name', 'email', 'subject', 'body', 'verifyCode'], 'required'],
			['email', 'email'],
			['verifyCode', 'captcha', 'captchaAction'=> 'tech/captcha'],
		];
	}

	public function attributeLabels()
	{
		return [
			'name' => Yii::t('user', 'Name'),
			'email' => Yii::t('user', 'Email'),
			'subject' => Yii::t('ul-general', 'Subject'),
			'body' => Yii::t('ul-general', 'Message'),
			'verifyCode' => Yii::t('ul-general', 'Verification Code'),
		];
	}

	public function contact($email)
	{
		if ($this->validate()) {
			Yii::$app->mailer->compose()
				->setTo($email)
				->setFrom([$this->email => $this->name])
				->setSubject($this->subject)
				->setTextBody($this->body)
				->send();

			return true;
		}
		return false;
	}
}
