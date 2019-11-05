<?php
use app\models\site\Sitemap;
use yii\base\View;
use yii\helpers\Url;

$doc = new DOMDocument('1.0', 'UTF-8');
$doc->formatOutput = YII_ENV_DEV;

$urlset = $doc->createElement('urlset');
$urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
$urlset->setAttribute('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance');
$urlset->setAttribute('xsi:schemaLocation', 'http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
$doc->appendChild($urlset);

foreach($pages as $page)
	Sitemap::ageData($doc, $urlset, Url::to([$page], true), filemtime(View::findViewFile('@app/views/' . $page)));

echo $doc->saveXML();
