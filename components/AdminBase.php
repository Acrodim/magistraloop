<?php

// Абстрактный класс содержит общую логику для контроллеров, которые используются в админ панели

abstract class AdminBase
{
	// Проверка является ли пользователь админом
	public static function checkAdmin()
	{
		// Проверка авторизован ли пользователь. Если нет, то будет переадресован
		$userId = User::checkLogged();

		// Получаем информацию о текущем пользователе
		$user = User::getUserById($userId);

		// Если роль текущего пользователя admin или pravlenie, то пускаем его в админпанель
		if ($user['role'] == 'admin' || $user['role'] == 'pravlenie') {
			$userRole = $user['role'];
			return $userRole;
		}

		// Иначе завершаем работу с сообщением о закрытом доступе
		die('Access denied');
	}
}