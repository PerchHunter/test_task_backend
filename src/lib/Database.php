<?php

	class Database
	{
		const DB_HOST = 'localhost';
		const DB_NAME = 'real_estate_agency';
		const DB_USER = 'root';
		const DB_PASS = '';
		const DB_CHAR = 'utf8';
		const DB_PORT = 3306;
		const OPTIONS = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => TRUE,
		];
		const DSN = 'mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME . ';charset=' . self::DB_CHAR;


		private static null|PDO $connect = null;

		private function __construct()
		{
		}

		public static function getConnect(): ?PDO
		{
			if (!self::$connect) {
				self::$connect = new PDO(self::DSN, self::DB_USER, self::DB_PASS, self::OPTIONS);
			}

			return self::$connect;
		}

		private static function prepareQuery(string $sql, array $args = []): PDOStatement
		{

			$statement = self::getConnect()->prepare($sql);
			$statement->execute($args);
			return $statement;
		}

		public static function insert(string $sql, array $args = []): int
		{
			self::prepareQuery($sql, $args);
			return self::$connect->lastInsertId();
		}

		public static function update($sql, $args = []): int
		{
			$stmt = self::prepareQuery($sql, $args);
			return $stmt->rowCount();
		}

		public static function select(string $sql, array $args = []): array
		{
			return self::prepareQuery($sql, $args)->fetchAll();
		}

		private function __clone()
		{
		}
	}