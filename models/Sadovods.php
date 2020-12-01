<?php

class Sadovods
{

	// Выборка всех садоводов
	public static function getAllSadovods()
	{
		$db = Db::getConnection();

		$users = array();

		$result = $db->query("SELECT id, CONCAT_WS(' ', surname, name) AS 'sadovod', phone, address, comment FROM users ORDER BY surname ASC");

		$i = 0;
			while ($row = $result->fetch()) {
				$users[$i]['id'] = $row['id'];
				$users[$i]['sadovod'] = $row['sadovod'];
				$users[$i]['phone'] = $row['phone'];
				$users[$i]['address'] = $row['address'];
				$users[$i]['comment'] = $row['comment'];
				$i++;
			}

			return $users;
	}

	// Выборка всех садоводов, живущих в СВТ
	public static function getSadovodsSvt()
	{
		$db = Db::getConnection();

		$usersSvt = array();

		$result = $db->query("SELECT id, CONCAT_WS(' ', surname, name) AS 'sadovod', phone, address, comment FROM users WHERE address = 'СВТ' ORDER BY surname ASC");

		$i = 0;
			while ($row = $result->fetch()) {
				$usersSvt[$i]['id'] = $row['id'];
				$usersSvt[$i]['sadovod'] = $row['sadovod'];
				$usersSvt[$i]['phone'] = $row['phone'];
				$usersSvt[$i]['address'] = $row['address'];
				$usersSvt[$i]['comment'] = $row['comment'];
				$i++;
			}

			return $usersSvt;
	}

	// Выборка количества садоводов
	public static function getCountSadovods()
	{
		$db = Db::getConnection();

		$countUsers = array();

		$result = $db->query("SELECT COUNT(id) AS 'count' FROM users");

		$countUsers = $result->fetch();

		return $countUsers;
	}

	// Выборка количества садоводов, живущих в СВТ
	public static function getCountSadovodsSvt()
	{
		$db = Db::getConnection();

		$countUsersSvt = array();

		$result = $db->query("SELECT COUNT(id) AS 'count' FROM users WHERE address = 'СВТ'");

		$countUsersSvt = $result->fetch();

		return $countUsersSvt;
	}

	// Получение данных садовода по id
	public static function getSadovodById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$result = $db->query("SELECT id, surname, name, phone, address, comment FROM users WHERE id = $id");
			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result->fetch();
		}
	}

	// Добавление нового садовода
	public static function createSadovod($options)
	{
		// Соединение с БД
		$db = Db::getConnection();

		// Запрос к БД
		$sql = 'INSERT INTO users (surname, name, phone, address, comment) VALUES (:surname, :name, :phone, :address, :comment)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':surname', $options['surname'], PDO::PARAM_STR);
		$result->bindParam(':name', $options['name'], PDO::PARAM_STR);
		$result->bindParam(':phone', $options['phone'], PDO::PARAM_STR);
		$result->bindParam(':address', $options['address'], PDO::PARAM_STR);
		$result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
		if ($result->execute()) {
			// Если запрос выполнен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
		// Иначе возвращаем 0
		return 0;
	}

	// Редактирование данных выбранного садовода
	public static function updateSadovodById($id, $options)
	{
		// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE users
            SET 
                surname = :surname, 
                name = :name, 
                phone = :phone, 
                address = :address, 
                comment = :comment
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':surname', $options['surname'], PDO::PARAM_STR);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':phone', $options['phone'], PDO::PARAM_STR);
        $result->bindParam(':address', $options['address'], PDO::PARAM_STR);
        $result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
        return $result->execute();
	}

	// Удаление садовода
	public static function deleteSadovodById($id)
	{
		// Соединение с БД
		$db = Db::getConnection();

		$sql = "DELETE FROM users WHERE id = :id";

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	}
}