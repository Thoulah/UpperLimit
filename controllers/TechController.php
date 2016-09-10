<?php
namespace app\controllers;
use Yii;
use app\models\MenuItems;
use yii\base\Object;
use yii\captcha\CaptchaAction;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\HttpCache;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class TechController extends Controller
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
		];
	}

	public function behaviors()
	{
		return [
			[
				'class' => HttpCache::className(),
				'only' => ['faviconico'],
				'lastModified' => function (Object $action, $params) {
					return filemtime(Yii::getAlias('@assetsPath/images/'.Yii::$app->params['favicon']));
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

	public function actionFaviconico()
	{
		Yii::$app->response->sendFile(Yii::getAlias('@assetsPath/images/'.Yii::$app->params['favicon']), 'favicon.ico', ['inline' => true]);
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
