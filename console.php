<?php
$config = [
	'id' => 'mr42-console',
	'aliases' => [
		'@web' => 'https://www.upperlimit.eu/',
	],

	'controllerNamespace' => 'app\commands',
	'modules' => [
		'user' =>  Da\User\Module::class,
	],
];

return $config;
