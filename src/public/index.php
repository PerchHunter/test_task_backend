<?php
	session_start();

	include_once "../configurations/autoload.php";


	$action = 'action_';
	$action .= $_GET['act'] ?? 'index';

	$controller = match ($_GET['c']) {
		'page' => new PageController,
		'user' => new UsersController,
		'admin' => new AdminController,
		default => new PageController,
	};

	$controller->Request($action);

