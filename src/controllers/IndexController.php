<?php


	abstract class IndexController
	{

		// Функция отрабатывающая до основного метода
		abstract protected function before();

		// Генерация внешнего шаблона
		abstract protected function render();

		public function Request($action)
		{
			$this->before();    //метод вызывается до формирования данных для шаблон
			$this->$action();   //$this->action_index
			$this->render();
		}

		/*
		 * Запрос произведен методом GET?
		 * */
		protected function IsGet(): bool
		{
			return $_SERVER['REQUEST_METHOD'] == 'GET';
		}

		/*
		 * Запрос произведен методом POST?
		 * */
		protected function IsPost(): bool
		{
			return $_SERVER['REQUEST_METHOD'] == 'POST';
		}

		/*
		 * Генерация HTML шаблона в строку.
		 *
		 * @param string $fileName
		 * @param array $vars
		 *
		 * @return string Выводит сформированный контент из буфера
		 * */
		protected function Template(string $fileName, array $vars = []): string
		{
			// Установка переменных для шаблона.
			foreach ($vars as $key => $value) {
				$$key = $value;
			}

			// Генерация HTML в строку.
			ob_start();
			require "../$fileName";
			return ob_get_clean();
		}

		// Если вызвали метод, которого нет - завершаем работу
		public function __call($name, $params)
		{
			die('Не пишите фигню в url-адресе!!!');
		}
	}