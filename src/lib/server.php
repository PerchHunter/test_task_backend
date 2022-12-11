<?php
	include_once '../configurations/autoload.php';

	$action = 'index';
	$requestedModel = '';

	if (isset($_POST['action'])) {
		$action = $_POST['action'];
		$requestedModel = $_POST['model'];
	}
	elseif (isset($_GET['action'])) {
		$action = $_GET['action'];
		$requestedModel = $_GET['model'];
	}

	$model = match ($requestedModel) {
		'admin' => new AdminModel,
		'user' => new UsersModel,
		default => new PageModel,
	};

	echo $model->$action();



