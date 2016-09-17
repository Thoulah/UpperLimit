<?php
namespace app\models;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

class MenuItems
{
	public static function menuArray() {
		$isGuest = (Yii::$app->controller->action->id == 'sitemapxml') ? true : Yii::$app->user->isGuest;
		$isAdmin = (!$isGuest && Yii::$app->user->identity->isAdmin) ? true : false;
		$username = $isGuest ? '' : Yii::$app->user->identity->username;

		$menuItems = [
			['label' => Yii::t('ul-menu', 'Contact'), 'url' => ['/site/contact']],
			$isGuest ?
				['label' => Yii::t('user', 'Login'), 'url' => ['/user/security/login']]
			:
				['label' => Yii::t('user', 'Hello').' '.$username, 'url' => null,
					'items' => [
						['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
						['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
#						['label' => Yii::t('user', 'Networks'), 'url' => ['/user/settings/networks']],
						'<li class="divider"></li>',
						['label' => Yii::t('user', 'Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
					],
				]
			,
			['label' => Html::img(Yii::$app->assetManager->baseUrl.'/images/lang-de.png', ['alt' => 'Deutsch']), 'url' => '@siteDE'.Url::to(Url::current()), 'options' => ['class' => 'flag'], 'visible' => (Yii::$app->language != 'de')],
			['label' => Html::img(Yii::$app->assetManager->baseUrl.'/images/lang-en.png', ['alt' => 'English']), 'url' => '@siteEN'.Url::to(Url::current()), 'options' => ['class' => 'flag'], 'visible' => (Yii::$app->language != 'en')],
		];

		return $menuItems;
	}

	public static function urlList() {
		$pages = [];
		$menu = self::menuArray();

		foreach ($menu as $item) {
			if (isset($item['visible'])) continue;

			if (isset($item['url'])) {
				$pages[] = $item['url'][0];
			}

			if (isset($item['items'])) {
				foreach ($item['items'] as $subitem) {
					if (isset($subitem['visible'])) continue;

					if (isset($subitem['url'])) {
						$pages[] = $subitem['url'][0];
					}
				}
			}
		}

		return $pages;
	}
}
