<?php

	class PageModel extends IndexModel
	{
		/*
		 *  Метод должен что-то делать для главной страницы
		 * */
		public function index(): string
		{
			return '';
		}

		/*
		 * Выдаёт из БД данные для отображения карточек в каталоге сайта
		 * */
		public function catalog(): string
		{
			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status 
					FROM real_estate_objects
					WHERE status = ?";
				$args = [1];
				$resultQuery = Database::select($sql, $args);

				return json_encode($resultQuery, JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}


		/*
		 * Сортировка по стоимости
		 * */
		public function sorting(): string
		{
			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status 
					FROM real_estate_objects
					WHERE status = ?
					ORDER BY price";
				$args = [1];
				$resultQuery = Database::select($sql, $args);

				return json_encode($resultQuery, JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}

		/*
		 * Выдаёт из БД данные о конкретном объекте недвижимости
		 * */
		public function showone(): string
		{
			$id = $_GET['id'];

			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status
					FROM real_estate_objects
					WHERE id = ?";
				$args = [$id];
				$resultQuery = Database::select($sql, $args);

				return json_encode($resultQuery[0], JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}

		/*
		 * Возвращает объекты недвижимости в соответствии с параметрами "вариант поиска" и статус объекта
		 * */
		public function search(): string
		{
			$variant = $_GET['variantSearch'];
			$text = $_GET['textSearch'];
			$status = 1; //статус актуально - не актуально

			$sqlVariant = match ($variant) {
				'houseNumber' => "house_number = ?",
//				default => '',
			};

			$sqlStatus = match ($status) {
				1 => "status = ?",
//				default => '',
			};

			try {
				$sql = "SELECT id, name_of_the_object, path_to_photo, address, house_number, flat_number, description, price, status 
					FROM real_estate_objects
					WHERE $sqlVariant AND $sqlStatus";
				$args = [$text, $status];
				$resultQuery = Database::select($sql, $args);

				return json_encode($resultQuery, JSON_UNESCAPED_UNICODE);

			} catch (PDOException $e) {
				return json_encode(["errorMessage" => "Данные не загружены. Ошибка: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
			}
		}
	}