<?php
namespace app\models;
use Yii;
use yii\bootstrap4\Html;
use yii\helpers\Url;

class MenuItems {
	public static function menuArray() {
		$isGuest = (Yii::$app->controller->action->id == 'sitemapxml') ? true : Yii::$app->user->isGuest;
		$isAdmin = !$isGuest && Yii::$app->user->identity->isAdmin;

		$menuItems = [
			['label' => Yii::$app->icon->name('home')->class('mr-1').Yii::t('yii', 'Home'), 'url' => ['/site/index']],
			['label' => Yii::$app->icon->name('music')->class('mr-1').Yii::t('site/music', 'Music'), 'url' => ['/site/music']],
			['label' => Yii::$app->icon->name('pencil-alt')->class('mr-1').Yii::t('site/contact', 'Contact'), 'url' => ['/site/contact']],
			$isGuest
				? ['label' => Yii::$app->icon->name('sign-in-alt')->class('mr-1').Yii::t('user', 'Login'), 'url' => ['/user/security/login'], 'visible' => 1]
				: ['label' => Yii::$app->icon->name('user')->class('mr-1').Yii::t('user', 'Hello').' '.Yii::$app->user->identity->username, 'url' => null,
					'items' => [
						['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
						['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
#						['label' => Yii::t('user', 'Networks'), 'url' => ['/user/settings/networks']],
						Html::tag('li', null, ['class' => 'divider']),
						['label' => Yii::t('user', 'Logout'), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']],
					],
				]
			,
			['label' => Html::img(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/lang-de.png', ['alt' => 'Deutsch']), 'url' => '@siteDE'.Url::to(Url::current()), 'options' => ['class' => 'flag', 'hreflang' => 'de', 'rel' => 'alternate'], 'visible' => (Yii::$app->language != 'de')],
			['label' => Html::img(Yii::$app->assetManager->getBundle('app\assets\ImagesAsset')->baseUrl.'/lang-en.png', ['alt' => 'English']), 'url' => '@siteEN'.Url::to(Url::current()), 'options' => ['class' => 'flag', 'hreflang' => 'en', 'rel' => 'alternate'], 'visible' => (Yii::$app->language != 'en')],
		];

		return $menuItems;
	}

	public static function urlList() {
		foreach (self::menuArray() as $item) :
			if (isset($item['visible']))
				continue;

			if (isset($item['url']))
				$pages[] = $item['url'][0];

			if (isset($item['items'])) {
				foreach ($item['items'] as $subitem) :
					if (isset($subitem['visible']))
						continue;

					if (isset($subitem['url']))
						$pages[] = $subitem['url'][0];
				endforeach;
			}
		endforeach;
		return $pages;
	}
}
