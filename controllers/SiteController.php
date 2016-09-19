<?php
namespace app\controllers;
use Yii;
use app\models\site\Contact;
use yii\web\ErrorAction;
use yii\web\Controller;

class SiteController extends Controller
{
	public function actions()
	{
		return [
			'error' => [
				'class' => ErrorAction::className(),
			],
		];
	}

	public function actionIndex()
	{
		return $this->render('index');
	}

	public function actionContact()
	{
		$model = new Contact();
		if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');

			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}
}
