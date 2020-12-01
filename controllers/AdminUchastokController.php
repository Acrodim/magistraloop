<?php

// Управление участками в админпанели

class AdminUchastokController extends AdminBase
{
	# Action для страницы "Просмотр участка"
	public function actionView($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		// Получаем данные о конкретном участке
        $uchastok = Uchastki::getUchastokById($id);

		// Подключаем вид
		require_once(ROOT . '/views/admin_uchastki/index.php');
		return true;
	}

	# Action для страницы "Добавить участок"
	public function actionCreate()
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		// Получаем список садоводов для выпадающего списка
		$users = Sadovods::getAllSadovods();

		$options['uchastok_id'] = '';
		$options['user_id'] = '';
		$options['square'] = '';
		$options['private'] = '';
		$options['comment'] = '';

		// Обработка формы
		if (isset($_POST['add'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$options['uchastok_id'] = $_POST['uchastok_id'];
			$options['user_id'] = $_POST['user_id'];
			$options['square'] = $_POST['square'];
			$options['private'] = $_POST['private'];
			$options['comment'] = $_POST['comment'];

			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать поля нужным образом
			if (!isset($options['uchastok_id']) || empty($options['uchastok_id'])) {
				$errors[] = "Заполните поле '№ уч.'";
			}

			if ($errors == false) {
				// Если ошибок нет
				// Добавляем новый товар
	
				$id = Uchastki::createUchastok($options);

				// Перенаправляем пользователя на страницу управления товарами
				header("Location: /uchastki");
			}
		} 

		// Подключаем вид
		require_once(ROOT . '/views/admin_uchastki/create.php');
		return true;

	}

	# Action для страницы "Редактировать товар"
	 public function actionUpdate($id)
    {
        // Проверка доступа
        $userRole = self::checkAdmin();

        // Получаем список садоводов для выпадающего списка
		$users = Sadovods::getAllSadovods();

        // Получаем данные о конкретном участке
        $uchastok = Uchastki::getUchastokById($id);

        // Обработка формы
        if (isset($_POST['update'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['uchastok_id'] = $_POST['uchastok_id'];
            $options['user_id'] = $_POST['user_id'];
            $options['square'] = $_POST['square'];
            $options['comment'] = $_POST['comment'];
            $options['private'] = $_POST['private'];

    		// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать поля нужным образом
			/*if (!isset($options['uchastok_id']) || empty($options['uchastok_id'])) {
				$errors[] = "Заполните поле '№ уч.'";
			}*/

			if ($errors == false) {
	            // Сохраняем изменения
	            Uchastki::updateUchastokById($id, $options);

	            // Перенаправляем пользователя на страницу управлениями товарами
	            header("Location: /uchastki");
	        }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_uchastki/update.php');
        return true;
    }

    # Action для страницы "Удалить товар"
	public function actionDelete($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Удаляем товар
			Uchastki::deleteUchastokById($id);

			// Перенаправляем на страницу управления товарами
			header("Location: /uchastki");
		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_uchastki/delete.php');
		return true;
	}
}