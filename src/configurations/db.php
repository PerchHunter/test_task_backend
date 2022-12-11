<?php
	$config = [
		'db' => [
			'host' => 'localhost',
			'port' => 3306,
			'nameDB' => 'real_estate_agency',
			'charDB' => 'utf8',
			'user' => 'root',
			'password' => '',
			'options' => [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES => TRUE,
			]
		],
	];