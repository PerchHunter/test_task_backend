<?php
	spl_autoload_register(function ($className) {
		$dirs = ['controllers', 'models', 'lib'];
		$file = $className . '.php';

		foreach ($dirs as $dir) {
			if (is_file("../$dir/$file")) {
				require_once "../$dir/$file";
			}
		}
	});