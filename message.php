<?php
return [
	'interactive' => true,
	'sourcePath' => '@app',
	'messagePath' => 'messages',
	'languages' => ['de'],
	'translator' => 'Yii::t',
	'sort' => true,
	'overwrite' => true,
	'removeUnused' => false,
	'markUnused' => true,
	'except' => [
		'.git',
		'.gitignore',
		'.gitkeep',
		'/messages',
	],
	'only' => ['*.php'],
	'format' => 'php',
	'ignoreCategories' => ['app', 'user', 'yii'],
];
