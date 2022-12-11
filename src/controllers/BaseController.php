<?php

	/*
	 * Базовый контроллер сайта.
	 * */
	class BaseController extends IndexController
	{

		protected string $title;           // заголовок страницы
		protected string $content;         // содержание страницы
		protected string $successMessage;  // сообщение пользователю об успешном выполнении действия
		protected string $errorMessage;    // сообщение пользователю об ошибке

		protected function before()
		{
			$this->title = '';
			$this->content = '';
			$this->successMessage = '';
			$this->errorMessage = '';
		}

		/*
		 * Генерация базового шаблона
		 * */
		public function render()
		{
			$vars = ['title' => $this->title, 'content' => $this->content];
			$page = $this->Template('views/index.php', $vars);
			echo $page;
		}
	}
