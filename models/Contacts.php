<?php

class Contacts
{

	// Выборка всех контактов
	public static function getAllContacts()
	{
		$db = Db::getConnection();

		$contacts = array();

		$result = $db->query("SELECT id, column_1, column_2, column_3, contact_order FROM contacts ORDER BY contact_order ASC");

		$i = 0;
			while ($row = $result->fetch()) {
				$contacts[$i]['id'] = $row['id'];
				$contacts[$i]['column_1'] = $row['column_1'];
				$contacts[$i]['column_2'] = $row['column_2'];
				$contacts[$i]['column_3'] = $row['column_3'];
				$contacts[$i]['contact_order'] = $row['contact_order'];
				$i++;
			}

			return $contacts;
	}

	// Выборка данных контакта по id
	public static function getContactById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$result = $db->query("SELECT * FROM contacts WHERE id = $id");
			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result->fetch();
		}
	}

	// Добавление нового контакта
	public static function createContact($options)
	{
		// Соединение с БД
		$db = Db::getConnection();

		// Запрос к БД
		$sql = 'INSERT INTO contacts (column_1, column_2, column_3, contact_order) VALUES (:column_1, :column_2, :column_3, :contact_order)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':column_1', $options['column_1'], PDO::PARAM_STR);
		$result->bindParam(':column_2', $options['column_2'], PDO::PARAM_STR);
		$result->bindParam(':column_3', $options['column_3'], PDO::PARAM_STR);
		$result->bindParam(':contact_order', $options['contact_order'], PDO::PARAM_INT);
		if ($result->execute()) {
			// Если запрос выполнен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
		// Иначе возвращаем 0
		return 0;
	}

	// Редактирование контакта
	public static function updateContactById($id, $options)
	{
		// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE contacts
            SET 
                column_1 = :column_1, 
                column_2 = :column_2, 
                column_3 = :column_3, 
                contact_order = :contact_order
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':column_1', $options['column_1'], PDO::PARAM_STR);
        $result->bindParam(':column_2', $options['column_2'], PDO::PARAM_STR);
        $result->bindParam(':column_3', $options['column_3'], PDO::PARAM_STR);
        $result->bindParam(':contact_order', $options['contact_order'], PDO::PARAM_INT);
        return $result->execute();
	}

	// Удаление контакта
	public static function deleteContactById($id)
	{
		// Соединение с БД
		$db = Db::getConnection();

		$sql = "DELETE FROM contacts WHERE id = :id";

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	}
}