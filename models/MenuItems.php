<?php
namespace app\models;
use Yii;
use yii\helpers\Html;

class MenuItems
{
	public static function menuArray() {
		$isGuest = (Yii::$app->controller->action->id == 'sitemapxml') ? true : Yii::$app->user->isGuest;
		$isAdmin = (!$isGuest && Yii::$app->user->identity->isAdmin) ? true : false;
		$username = $isGuest ? '' : Yii::$app->user->identity->username;

		$menuItems = [
			['label' => Yii::t('menu', 'About'), 'url' => ['/site/about']],
			['label' => Yii::t('menu', 'Contact'), 'url' => ['/site/contact']],
			$isGuest ?
				['label' => Yii::t('menu', 'Login'), 'url' => ['/user/security/login']]
			:
				['label' => Yii::t('menu', 'Logout {username}', ['username' => Yii::$app->user->identity->username]), 'url' => ['/user/security/logout'], 'linkOptions' => ['data-method' => 'post']]
			,
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
