<?php


	class PageController extends BaseController
	{

		private PageModel $pageModel;


		public function __construct()
		{
			$this->pageModel = new PageModel;
		}

		/*
		 * Метод должен что-то делать на главной странице сайта
		 * */
		public function action_index()
		{
			$this->title .= 'Главная';

			$this->content = $this->Template('views/page/homePage.php', []);
		}

		/*
		 * Каталог
		 * */
		public function action_catalog()
		{
			$this->title .= 'Каталог';

			$listOfCards = json_decode($this->pageModel->catalog(), true);

			$this->content = $this->Template('views/page/catalog.php', ["cards" => $listOfCards]);
		}

		/*
		 * Страница отдельного объекта недвижимости
		 * */
		public function action_showone()
		{
			$card = json_decode($this->pageModel->showone(), true);

			$this->title .= $card['name_of_the_object'];

			$this->content = $this->Template('views/page/showOneCard.php', ["card" => $card]);
		}

	}