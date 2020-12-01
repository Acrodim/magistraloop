<?php

// Управление участками в админпанели

class AdminElectroController extends AdminBase
{
	# Action для страницы "Добавить участок"
	public function actionCreate()
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		$userName = User::userName();

		$uchastki = Uchastki::getAllUchastki();

		$options['uchastok_id'] = '';
		$options['counter'] = '';
		$options['controller'] = '';
		$options['comment'] = '';

		// Обработка формы
		if (isset($_POST['add'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$options['uchastok_id'] = $_POST['uchastok_id'];
			$options['counter'] = $_POST['counter'];
			$options['controller'] = $_POST['controller'];
			$options['comment'] = $_POST['comment'];

			// Флаг ошибок в форме
			$errors = false;

			if ($errors == false) {
				// Если ошибок нет
				// Добавляем новые показания счётчика
				
				$id = Electro::createElectro($options);

				// Перенаправляем пользователя на страницу управления товарами
				header("Location: /electro");
			}
		} 

		// Подключаем вид
		require_once(ROOT . '/views/admin_electro/create.php');
		return true;

	}

	# Action для страницы "Удалить показания эл/счётчика"
	public function actionDelete($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		 // Получаем данные о конкретном садоводе
        $electro = Electro::getElectroById($id);

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Удаляем товар
			Electro::deleteElectroById($id);

			// Перенаправляем на страницу управления товарами
			header("Location: /electro");
		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_electro/delete.php');
		return true;
	}
}