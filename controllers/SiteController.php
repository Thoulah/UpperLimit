<?php
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\site\Contact;

class SiteController extends Controller
{
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
