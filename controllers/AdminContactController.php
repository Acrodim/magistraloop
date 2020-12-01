<?php

// Управление участками в админпанели

class AdminContactController extends AdminBase
{
	# Action для страницы "Добавить участок"
	public function actionCreate()
	{
		// Проверка доступа
		$userRole = self::checkAdmin();

		$options['column_1'] = '';
		$options['column_2'] = '';
		$options['column_3'] = '';
		$options['contact_order'] = '';

		// Обработка формы
		if (isset($_POST['add'])) {
			// Если форма отправлена
			// Получаем данные из формы
			$options['column_1'] = $_POST['column_1'];
			$options['column_2'] = $_POST['column_2'];
			$options['column_3'] = $_POST['column_3'];
			$options['contact_order'] = $_POST['contact_order'];

			// Флаг ошибок в форме
			$errors = false;

			if ($errors == false) {
				// Если ошибок нет
				// Добавляем нового садовода
				
				$id = Contacts::createContact($options);

				// Перенаправляем пользователя на страницу управления товарами
				header("Location: /contacts");
			}
		} 

		// Подключаем вид
		require_once(ROOT . '/views/admin_contacts/create.php');
		return true;

	}

	# Action для страницы "Редактировать контакт"
	 public function actionUpdate($id)
    {
        // Проверка доступа
        $userRole = self::checkAdmin();

        // Получаем данные о конкретном контакте
        $contact = Contacts::getContactById($id);

        // Обработка формы
        if (isset($_POST['update'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования. При необходимости можно валидировать значения
            $options['column_1'] = $_POST['column_1'];
            $options['column_2'] = $_POST['column_2'];
            $options['column_3'] = $_POST['column_3'];
            $options['contact_order'] = $_POST['contact_order'];

			// Флаг ошибок в форме
			$errors = false;

			// При необходимости можно валидировать поля нужным образом
			/*if (!isset($options['uchastok_id']) || empty($options['uchastok_id'])) {
				$errors[] = "Заполните поле '№ уч.'";
			}*/

			if ($errors == false) {
	            // Сохраняем изменения
	            Contacts::updateContactById($id, $options);

	            // Перенаправляем пользователя на страницу управлениями товарами
	            header("Location: /contacts");
	        }
        }

        // Подключаем вид
        require_once(ROOT . '/views/admin_contacts/update.php');
        return true;
    }

	# Action для страницы "Удалить садовода"
	public function actionDelete($id)
	{
		// Проверка доступа
		$userRole = self::checkAdmin();
		
        // Получаем данные о конкретном контакте
        $contact = Contacts::getContactById($id);

		 // Получаем данные о конкретном садоводе
        $user = Contacts::getContactById($id);

		// Обработка формы
		if (isset($_POST['submit'])) {
			// Если форма отправлена
			// Удаляем товар
			Contacts::deleteContactById($id);

			// Перенаправляем на страницу управления товарами
			header("Location: /contacts");
		}

		// Подключаем вид
		require_once(ROOT . '/views/admin_contacts/delete.php');
		return true;
	}
}