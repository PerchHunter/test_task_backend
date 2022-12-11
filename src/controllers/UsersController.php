<?php


	class UsersController extends BaseController
	{

		private UsersModel $user;

		public function __construct()
		{
			$this->user = new UsersModel;
		}


		/**
		 * Страница регистрации
		 */
		public function action_registration()
		{
			$this->title .= 'Регистрация';

			if ($this->IsPost()) {
				$resultRegistration = json_decode($this->user->registration());

				if (!$resultRegistration->errorMessage) {
					$this->successMessage = $resultRegistration->successMessage;
				}
				else $this->errorMessage = $resultRegistration->errorMessage;
			}

			$this->content = $this->Template('views/users/registration.php', ['errorMessage' => $this->errorMessage, 'successMessage' => $this->successMessage]);
		}


		/**
		 * Страница авторизации
		 */
		public function action_auth()
		{
			$this->title .= 'Авторизация';

			if ($this->IsPost()) {
				$resultAuth = json_decode($this->user->authorization());

				// если нет уведомления об ошибке, сохраняем куки
				if (!$resultAuth->errorMessage) {

					if ($_POST['rememberMe']) {
						setcookie('auth', $resultAuth->id, time() + 3600 * 24 * 7);
						setcookie('role', $resultAuth->role, time() + 3600 * 24 * 7);
					}
					else {
						setcookie('auth', $resultAuth->id);
						setcookie('role', $resultAuth->role);
					}

					header('Location: index.php?c=page&act=index');
				}

				$this->errorMessage = $resultAuth->errorMessage;
			}

			$this->content = $this->Template('views/users/authorization.php', ['errorMessage' => $this->errorMessage]);
		}
	}