<?php

// Управление участками в админпанели

class AdminSadovodController extends AdminBase
{
	# Action для страницы "Просмотр садовода"
	public function actionView($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		// Получаем данные о конкретном садоводе
        $user = Sadovods::getSadovodById($id);

        // Получаем данные по всем участкам определённого садовода
        $uchastkiBySadovod = Uchastki::getUchastkiByUserId($id);

		// Подключаем вид
		require_once(ROOT . '/views/admin_sadovods/index.php');
		return true;
	}

	# Action для страницы "Добавить участок"
	public function actionCreate()
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		$options['surname'] = '';
		$options['name'] = '';
		$options['phone'] = '';
		$options['address'] = '';
		$options['comment'] = '';

		// Обработка формы
		if (isset($_POST['add'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$options['surname'] = $_POST['surname'];
			$options['name'] = $_POST['name'];
			$options['phone'] = $_POST['phone'];
			$options['address'] = $_POST['address'];
			$options['comment'] = $_POST['comment'];

			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать поля нужным образом
			if (!isset($options['surname']) || empty($options['surname'])) {
				$errors[] = "Заполните поле 'Фамилия'!";
			}

			if ($errors == false) {
				// Если ошибок нет
				// Добавляем нового садовода
				
				$id = Sadovods::createSadovod($options);

				// Перенаправляем пользователя на страницу управления товарами
				header("Location: /sadovods");
			}
		} 

		// Подключаем вид
		require_once(ROOT . '/views/admin_sadovods/create.php');
		return true;

	}

	# Action для страницы "Редактировать товар"
	 public function actionUpdate($id)
    {
        // Проверка доступа
        $userRole = self::checkAdmin();

        // Получаем данные о конкретном садоводе
        $user = Sadovods::getSadovodById($id);

        // Обработка формы
        if (isset($_POST['update'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['surname'] = $_POST['surname'];
            $options['name'] = $_POST['name'];
            $options['phone'] = $_POST['phone'];
            $options['address'] = $_POST['address'];
            $options['comment'] = $_POST['comment'];


			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать поля нужным образом
			/*if (!isset($options['uchastok_id']) || empty($options['uchastok_id'])) {
				$errors[] = "Заполните поле '№ уч.'";
			}*/

			if ($errors == false) {
	            // Сохраняем изменения
	            Sadovods::updateSadovodById($id, $options);

	            // Перенаправляем пользователя на страницу управлениями товарами
	            header("Location: /sadovods");
	        }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_sadovods/update.php');
        return true;
    }

	# Action для страницы "Удалить садовода"
	public function actionDelete($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		 // Получаем данные о конкретном садоводе
        $user = Sadovods::getSadovodById($id);

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Удаляем товар
			Sadovods::deleteSadovodById($id);

			// Перенаправляем на страницу управления товарами
			header("Location: /sadovods");
		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_sadovods/delete.php');
		return true;
	}
}