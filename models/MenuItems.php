<?php
namespace app\models;
use Yii;

class MenuItems
{
	public static function menuArray() {
		$isGuest = (Yii::$app->controller->action->id == 'sitemapxml') ? true : Yii::$app->user->isGuest;
		$isAdmin = (!$isGuest && Yii::$app->user->identity->isAdmin) ? true : false;
		$username = $isGuest ? '' : Yii::$app->user->identity->username;

		$menuItems = [
			['label' => 'About', 'url' => ['/site/about']],
			['label' => 'Contact', 'url' => ['/site/contact']],
			$isGuest ?
				['label' => 'Login', 'url' => ['/site/login']]
			: (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post', ['class' => 'navbar-form'])
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link']
                )
                . Html::endForm()
                . '</li>'
            )
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
