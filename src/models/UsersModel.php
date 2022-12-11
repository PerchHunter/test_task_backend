<?php


	class UsersModel extends IndexModel
	{

		public function index(): string
		{
			return '';
		}

		/**
		 * Регистрация пользователя
		 *
		 * @return string
		 */
		public function registration(): string
		{
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Methods: POST");
			header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

			foreach ($_POST as $key => $value) {
				$$key = htmlspecialchars(strip_tags(trim($value)));

				$validResult = self::validationData($key, $$key);
				if ($validResult) {
					return json_encode(["errorMessage" => $validResult], JSON_UNESCAPED_UNICODE);
				}
			}

			//солим и шифруем
			$salt = strrev($password) . $password . strrev($password);
			$password = md5($salt);

			try {
				$sql = "INSERT INTO users(name, surname, login, email, password)
					VALUES (?, ?, ?, ?, ?)";
				$args = [$name, $surname, $login, $email, $password];
				Database::insert($sql, $args);

			} catch (PDOException $e) {
				if ($e->getCode() == 23000) {
					if (preg_match("/Duplicate entry 'admin'/", $e->getMessage())) {
						$errorMessage = "Пользователь с таким логином уже существует";
					} elseif (preg_match("/Duplicate entry 'login'/", $e->getMessage())) {
						$errorMessage = "Пользователь с такой почтой уже существует";
					} else {
						$errorMessage = 'Во время регистрации произошла непредвиденная ошибка. Код ошибки: ' . $e->getCode();
					}

					return json_encode(["errorMessage" => $errorMessage], JSON_UNESCAPED_UNICODE);
				}
			}

			return json_encode(["successMessage" => "Вы успешно зарегистрированы"], JSON_UNESCAPED_UNICODE);
		}


		/**
		 * Авторизация пользователя
		 *
		 * @return string
		 */
		public
		function authorization(): string
		{
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Headers: access");
			header("Access-Control-Allow-Methods: POST");
			header("Access-Control-Allow-Credentials: true");

			foreach ($_POST as $key => $value) {
				//чистим, преобразуем в переменные $login, $password и т. д.
				$$key = htmlspecialchars(strip_tags(trim($value)));
			}

			//солим и шифруем
			$salt = strrev($password) . $password . strrev($password);
			$password = md5($salt);

			$sql = "SELECT *
					FROM users
					WHERE login = ? AND password = ?";
			$args = [$login, $password];
			$resultQuery = Database::select($sql, $args);

			if (count($resultQuery)) {
				http_response_code(200);
				return json_encode($resultQuery[0], JSON_UNESCAPED_UNICODE);
			} else {
				http_response_code(404);
				return json_encode(["errorMessage" => "Пользователь с таким логином и паролем не найден"], JSON_UNESCAPED_UNICODE);
			}
		}


		/**
		 * @param string $key Название переменной
		 * @param string $value Значение переменной
		 *
		 * @return string|null уведомление о некорректных данных | если всё ОК - null
		 */
		private function validationData(string $key, string $value): ?string
		{
			switch ($key) {
				case 'name':
				case 'surname':
				case 'login':
					if (!preg_match('/^[a-zA-Zа-яА-ЯЁё\-]{2,50}$/u', $value)) {
						return 'Имя и фамилия могут состоять из символов a-zA-Zа-яА-ЯЁё и дефиса(-)';
					}
					break;
				case 'email':
					if (!preg_match('/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/', $value)) {
						return 'Введён некорректный email';
					}
					break;
				case 'password':
					if (strlen($value) < 8) return 'Пароль должен быть длиной 8 символов и более';
					break;
			}

			return null;
		}
	}