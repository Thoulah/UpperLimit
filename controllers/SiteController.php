<?php
namespace app\controllers;
use Yii;
use app\models\MenuItems;
use app\models\site\Contact;
use yii\base\Object;
use yii\captcha\CaptchaAction;
use yii\filters\HttpCache;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Response;

class SiteController extends Controller
{
	public function actions()
	{
		return [
			'captcha' => [
				'class' => CaptchaAction::className(),
				'backColor' => 0xffffff,
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
				'foreColor' => 0x003e67,
				'transparent' => true,
			],
			'error' => [
				'class' => ErrorAction::className(),
			],
		];
	}

	public function behaviors()
	{
		return [
			[
				'class' => HttpCache::className(),
				'only' => ['faviconico'],
				'lastModified' => function (Object $action, $params) {
					return filemtime(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->basePath.'/favicon.ico');
				},
			],
			[
				'class' => HttpCache::className(),
				'only' => ['robotstxt'],
				'lastModified' => function (Object $action, $params) {
					return filemtime(Yii::getAlias('@app/views/'.$action->controller->id.'/'.$action->id.'.php'));
				},
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
		if ($model->load(Yii::$app->request->post()) && $model->contact()) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			return $this->refresh();
		}
		return $this->render('contact', [
			'model' => $model,
		]);
	}

	public function actionFaviconico()
	{
		Yii::$app->response->sendFile(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->basePath.'/favicon.ico', 'favicon.ico', ['inline' => true]);
	}

	public function actionOffline()
	{
		Yii::$app->response->statusCode = 503;
		Yii::$app->response->headers->add('Retry-After', 900);
		return $this->render('offline');
	}

	public function actionRobotstxt()
	{
		Yii::$app->response->format = Response::FORMAT_RAW;
		Yii::$app->response->headers->add('Content-Type', 'text/plain');
		return $this->renderPartial('robotstxt');
	}

	public function actionSitemapxml()
	{
		Yii::$app->response->format = Response::FORMAT_RAW;
		Yii::$app->response->headers->add('Content-Type', 'application/xml');

		$pages = MenuItems::urlList(); sort($pages);

		return $this->renderPartial('sitemapxml', [
			'pages' => $pages,
		]);
	}
}
