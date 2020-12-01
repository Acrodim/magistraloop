<?php

class Electro
{

	// Выборка данных по всем эл/счётчикам
	public static function getAllElectro()
	{
		$db = Db::getConnection();

		$electroAll = array();

		$result = $db->query("SELECT id, uchastok_id, counter, controller, DATE_FORMAT(date, '%d.%m.%Y') AS date_electro, comment FROM electro ORDER BY date DESC");

		$i = 0;
			while ($row = $result->fetch()) {
				$electro[$i]['id'] = $row['id'];
				$electro[$i]['uchastok_id'] = $row['uchastok_id'];
				$electro[$i]['counter'] = $row['counter'];
				$electro[$i]['controller'] = $row['controller'];
				$electro[$i]['date_electro'] = $row['date_electro'];
				$electro[$i]['comment'] = $row['comment'];
				$i++;
			}

			return $electro;
	}

	// Добавление новых показаний эл/счётчика
	public static function createElectro($options)
	{
		// Соединение с БД
		$db = Db::getConnection();

		// Запрос к БД
		$sql = 'INSERT INTO electro (uchastok_id, counter, controller, comment) VALUES (:uchastok_id, :counter, :controller, :comment)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':uchastok_id', $options['uchastok_id'], PDO::PARAM_STR);
		$result->bindParam(':counter', $options['counter'], PDO::PARAM_STR);
		$result->bindParam(':controller', $options['controller'], PDO::PARAM_STR);
		$result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
		if ($result->execute()) {
			// Если запрос выполнен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
		// Иначе возвращаем 0
		return 0;
	}

	// Получение показаний эл/счётчикам по id записи в таблице
	public static function getElectroById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$result = $db->query("SELECT id, uchastok_id, counter, controller, DATE_FORMAT(date, '%d.%m.%Y') AS date_electro, comment FROM electro WHERE id = $id");
			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result->fetch();
		}
	}

	// Удаление показаний определённого эл/счётчика за определённую дату
	public static function deleteElectroById($id)
	{
		// Соединение с БД
		$db = Db::getConnection();

		$sql = "DELETE FROM electro WHERE id = :id";

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	}
}