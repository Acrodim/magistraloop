<?php

class User
{
	// Проверяет поле имя: не меньше, чем 2 символа
	public static function checkName($name)
	{
		if (strlen($name) >= 2) {
			return true;
		} 
			return false;
	}

	// Проверяет поле пароль: не меньше, чем 6 символов
	public static function checkPassword($password)
	{
		if (strlen($password) >= 4) {
			return true;
		} 
			return false;
	}

	# Проверяет email
	public static function checkEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			return true;
		}
		return false;
	}

	// Проверяет связку логин+пароль в базе
	public static function checkUserData($login, $password)
	{
		$db = Db::getConnection();

		$sql = 'SELECT * FROM auth WHERE login = :login AND password = :password';
		
		$result = $db->prepare($sql);
		$result->bindParam(':login', $login, PDO::PARAM_INT);
		$result->bindParam(':password', $password, PDO::PARAM_INT);
		$result->execute();

		$user = $result->fetch();
		if($user) {
			return $user['id'];
		}

		return false;
	}

	public static function auth($userId)
	{
		$_SESSION['user'] = $userId;
	}

	// Проверяет залогиненный пользователь или нет
	public static function checkLogged()
	{
		// Если сессия есть, вернём идентификатор пользователя
		if (isset($_SESSION['user'])) {
			return $_SESSION['user'];
		}

		//header("Location: /user/login");
		
	}

	// Определяет роль пользователя
	public static function userRole()
	{
		$userRole = 'user';

		if (self::checkLogged()) {
			$userId = self::checkLogged();
			$user = self::getUserById($userId);
			if ($user['role'] == 'admin') {
				$userRole = 'admin';
			} elseif ($user['role'] == 'pravlenie') {
				$userRole = 'pravlenie';
			}
		} 

		return $userRole;
	}

	// Определяет имя пользователя
	public static function userName()
	{
		if (self::checkLogged()) {
			$userId = self::checkLogged();
			$user = self::getUserById($userId);
			$userName = Sadovods::getSadovodById($user['user_id']);
			$_SESSION['userName'] = $userName['surname'];
			return $_SESSION['userName'];
		}
	}

	// Определяет пользователь гость или нет
	public static function isGuest()
	{
		if (isset($_SESSION['user'])) {
			return false;
		}

		return true;
	}


	// Получает id пользователя
	public static function getUserById($id)
	{
		if ($id) {
			$db = Db::getConnection();
			$sql = 'SELECT * FROM auth WHERE id = :id';

			$result = $db->prepare($sql);
			$result->bindParam(':id', $id, PDO::PARAM_INT);

			// Указываем, что хотим получить данные в виде массива
			$result->setFetchMode(PDO::FETCH_ASSOC);
			$result->execute();

			return $result->fetch();
		}
	}
}