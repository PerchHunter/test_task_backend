<?php


	class AdminModel extends IndexModel
	{

		/*
		 * Получает карточки из БД для отображения в админке в разделе "Посмотреть все объекты"
		 * */
		public function index(): string
		{
			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status 
					FROM real_estate_objects";
				$resultQuery = Database::select($sql);

				return json_encode($resultQuery, JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}

		/*
		 * Сортировка в разделе "Посмотреть все объекты"
		 * */
		public function sorting(): string
		{
			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status 
					FROM real_estate_objects
					ORDER BY price";
				$resultQuery = Database::select($sql);

				return json_encode($resultQuery, JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}

		/*
		 * Добавляет новые объекты недвижимости в БД
		 * */
		public function add(): string
		{
			foreach ($_POST as $key => $value) {
				// пример работы: ['houseNumber' => 81] преобразуется в $houseNumber = 81
				$$key = htmlspecialchars(strip_tags(trim($value)));
			}

			// номер квартиры
			$flatNumber = $flatNumber > 0 ? $flatNumber : null;

			// т.к. не получилось сделать загрузку файлов, ставлю фото по умолчанию
			// полный путь будет ./images/catalog/default.png
			$pathToPhoto = 'default.png';

			try {
				$sql = "INSERT INTO real_estate_objects (name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
				$args = [$nameOfObject, $pathToPhoto, $street, $houseNumber, $flatNumber, $description, $price, $status];
				Database::insert($sql, $args);

				return json_encode(['successMessage' => "Успешно добавлено"], JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(['errorMessage' => "Запись не добавлена. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}

		}

		/*
		 * обновление статуса объявления в админке
		 * */
		public function updateStatusCard(): string
		{
			// получил данные из запроса
			$_PATCH = json_decode(file_get_contents("php://input"));
			$_PATCH = get_object_vars($_PATCH);

			if ($_PATCH['action'] === 'update-status') {
				try {
					$sql = "SELECT status FROM real_estate_objects WHERE id = ?";
					$checkQuery = Database::select($sql, [$_PATCH['idCard']]);

					$resultSql = "UPDATE real_estate_objects  SET status = ?";
					$args = [$_PATCH['newStatus'], $_PATCH['idCard']];

					if ($checkQuery[0]['status'] === $_PATCH['newStatus']) return json_encode(['statusCard' => $checkQuery[0]['status']]);
					elseif ($_PATCH['newStatus'] === '1') $resultSql .= ", close_at = now() WHERE id = ?";
					elseif ($_PATCH['newStatus'] === '2') $resultSql .= ", close_at = null WHERE id = ?";

					Database::update($resultSql, $args);
					return json_encode(['statusCard' => $_PATCH['newStatus'], 'successMessage' => "Изменено"]);

				} catch (PDOException $e) {
					return json_encode(['errorMessage' => "Ошибка: $e->getMessage", 'result' => false]);
				}
			}
		}

		/*
		 * обновление всех данных объявления
		 * */
		public function updateAllDataInCard(): string
		{
			// получил данные из запроса
			$_PATCH = json_decode(file_get_contents("php://input"));
			$_PATCH = get_object_vars($_PATCH);

			$_PATCH['flatNumber'] = $_PATCH['flatNumber'] ?? null;

			// ставлю фото по умолчанию, т.к. не получалось загружать их на сервер
			$photo = 'default.png';

			try {
				$sql = "UPDATE real_estate_objects
							SET name_of_the_object = ?, path_to_photo = ?, address = ?, house_number = ?, flat_number = ?, description = ?, price = ?, status = ?
							WHERE id = ?";

				$args = [$_PATCH['nameOfObject'], $photo, $_PATCH['street'], (int)$_PATCH['houseNumber'], (int)$_PATCH['flatNumber'], $_PATCH['description'], (int)$_PATCH['price'], (int)$_PATCH['status'], (int)$_GET['id']];

				Database::update($sql, $args);
				return json_encode(['successMessage' => "Информация успешно обновлена"], JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(['errorMessage' => "Информация не обновлена. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}

	}