<?php

return [

	'' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'index\.php(\?page=\d+)' => [
		'controller' => 'main',
		'action' => 'index',
	],

	'account/login' => [
		'controller' => 'account',
		'action' => 'login',
	],

	'account/logout' => [
		'controller' => 'account',
		'action' => 'logout',
	],

	'task/add' => [
		'controller' => 'task',
		'action' => 'add',
	],

	'task/edit' => [
		'controller' => 'task',
		'action' => 'edit',
	],

];