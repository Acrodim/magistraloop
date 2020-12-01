<?php

class UserController
{
	// Action входа пользователя
	public function actionLogin()
	{
		$login = '';
		$password = '';

		// Роль пользователя
		$userRole = User::userRole();

		if (isset($_POST['submit'])) {
			$login = $_POST['login'];
			$password = $_POST['password'];

			$errors = false;

			// Валидация полей
			if (!User::checkName($login)) {
				$errors[] = 'Неправильный логин!';
			}

			if (!User::checkPassword($password)) {
				$errors[] = 'Пароль не должен быть короче 6-ти символов!';
			}

			// Проверяем существует ли пользователь
			$userId = User::checkUserData($login, $password);

			if ($userId == false) {
				$errors[] = 'Неправильные данные для входа на сайт!';
			} else {
				// Если данные правильные, записываем пользователя в сессию
				User::auth($userId);

				// Перенаправляем авторизованного пользователя на главную страницу
				header("Location: /");
			}
		}

		require_once (ROOT . '/views/user/login.php');

		return true;
	}

	// Action для выхода пользователя
	public function actionLogout()
	{
		unset($_SESSION['user']);
		header("Location: /");
	}
}