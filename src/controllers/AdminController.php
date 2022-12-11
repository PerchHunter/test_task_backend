<?php


	class AdminController extends BaseController
	{
		private AdminModel $adminModel;
		private PageModel $pageModel;

		public function __construct()
		{
			$this->adminModel = new AdminModel;
			$this->pageModel = new PageModel;
		}

		/*
		 * Страница просмотра всех карточек
		 * */
		public function action_index()
		{
			$this->title .= 'Админка';
			$listOfCards = json_decode($this->adminModel->index(), true);

			$this->content = $this->Template('views/admin/showCards.php', ["cards" => $listOfCards]);
		}

		/*
		 * Страница добавления новых объектов недвижимости
		 * */
		public function action_add()
		{
			$this->title .= 'Админка';

			$this->content = $this->Template('views/admin/add.php', []);
		}

		/*
		 * Страница изменения информации в карточке товара
		 * */
		public function action_update()
		{
			$this->title .= 'Страница обновления информации';

			$cardData = json_decode($this->pageModel->showone(), true);

			$this->content = $this->Template('views/admin/updateCard.php', ['cardData' => $cardData]);
		}
	}