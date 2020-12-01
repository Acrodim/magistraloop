<?php

class Uchastki
{
	// Выборка всех участков
	public static function getAllUchastki()
	{
		$db = Db::getConnection();

		$uchastki = array();

		$result = $db->query("SELECT uch.id AS 'uchastok_id', uch.square, uch.private, uch.comment AS 'comment', CONCAT_WS(' ', u.surname, u.name) AS 'sadovod', u.id AS user_id FROM uchastki uch
		LEFT JOIN users u ON uch.user_id = u.id
		ORDER BY length(uch.id), uch.id ASC");

		$i = 0;
			while ($row = $result->fetch()) {
				$uchastki[$i]['uchastok_id'] = $row['uchastok_id'];
				$uchastki[$i]['square'] = $row['square'];
				$uchastki[$i]['comment'] = $row['comment'];
				$uchastki[$i]['private'] = $row['private'];
				$uchastki[$i]['sadovod'] = $row['sadovod'];
				$uchastki[$i]['user_id'] = $row['user_id'];
				$i++;
			}

			return $uchastki;
	}

	// Получение количества участков
	public static function getUchastkiCount()
	{
		$db = Db::getConnection();

		$uchastki = array();

		$result = $db->query("SELECT COUNT(id) as count, SUM(square) AS total_square FROM uchastki");

		$uchastkiCount = $result->fetch();

		return $uchastkiCount;
	}

	// Получение статистики по приватизированным участкам
	public static function getPrivatUchastki()
	{
		$db = Db::getConnection();

		$uchastkiPrivat = array();

		$result = $db->query("SELECT SUM(square) AS total_square, COUNT(id) as count FROM uchastki WHERE private = 'Да'");

		$uchastkiPrivat = $result->fetch();

		return $uchastkiPrivat;
	}

	// Получение статистики по НЕприватизированным участкам
	public static function getNotPrivatUchastki()
	{
		$db = Db::getConnection();

		$uchastkiNotPrivat = array();

		$result = $db->query("SELECT SUM(square) AS total_square, COUNT(id) as count FROM uchastki WHERE private = 'Нет'");

		$uchastkiNotPrivat = $result->fetch();

		return $uchastkiNotPrivat;
	}

	// Получение всех участков по id юзера
	public static function getUchastkiByUserId($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$uchastki = array();

			$result = $db->query("SELECT uch.id AS 'uchastok_id', uch.square, uch.private, uch.comment AS 'comment', CONCAT_WS(' ', u.surname, u.name) AS 'sadovod', u.phone, u.address FROM uchastki uch
			LEFT JOIN users u ON uch.user_id = u.id
			WHERE u.id = $id
			ORDER BY length(uch.id), uch.id ASC");

			$i = 0;
				while ($row = $result->fetch()) {
					$uchastki[$i]['uchastok_id'] = $row['uchastok_id'];
					$uchastki[$i]['square'] = $row['square'];
					$uchastki[$i]['comment'] = $row['comment'];
					$uchastki[$i]['private'] = $row['private'];
					$uchastki[$i]['sadovod'] = $row['sadovod'];
					$i++;
				}

				return $uchastki;
		}
	}

	// Добавление нового участка
	public static function createUchastok($options)
	{
		// Соединение с БД
		$db = Db::getConnection();

		// Запрос к БД
		$sql = 'INSERT INTO uchastki (id, user_id, square, private, comment) VALUES (:uchastok_id, :user_id, :square, :private, :comment)';

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':uchastok_id', $options['uchastok_id'], PDO::PARAM_INT);
		$result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
		$result->bindParam(':square', $options['square'], PDO::PARAM_STR);
		$result->bindParam(':private', $options['private'], PDO::PARAM_STR);
		$result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
		if ($result->execute()) {
			// Если запрос выполнен успешно, возвращаем id добавленной записи
			return $db->lastInsertId();
		}
		// Иначе возвращаем 0
		return 0;
	}

	// Получение всех участков по id участка
	public static function getUchastokById($id)
	{
		$id = intval($id);

		if ($id) {
			$db = Db::getConnection();

			$result = $db->query("SELECT uch.id AS 'uchastok_id', uch.square AS 'square', uch.private, uch.comment AS 'comment', CONCAT_WS(' ', u.surname, u.name) AS 'sadovod', u.id AS user_id, e.counter, DATE_FORMAT(e.date, '%d.%m.%Y') AS date FROM uchastki uch
			LEFT JOIN users u ON uch.user_id = u.id
			LEFT JOIN electro e ON uch.id = e.uchastok_id
			WHERE uch.id = $id");
			$result->setFetchMode(PDO::FETCH_ASSOC);

			return $result->fetch();
		}
	}

	// Редактирование данных участка
	public static function updateUchastokById($id, $options)
	{
		// Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE uchastki
            SET 
                user_id = :user_id, 
                square = :square, 
                private = :private, 
                comment = :comment
            WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_id', $options['user_id'], PDO::PARAM_INT);
        $result->bindParam(':square', $options['square'], PDO::PARAM_STR);
        $result->bindParam(':private', $options['private'], PDO::PARAM_STR);
        $result->bindParam(':comment', $options['comment'], PDO::PARAM_STR);
        return $result->execute();
	}

	// Удаление участка
	public static function deleteUchastokById($id)
	{
		// Соединение с БД
		$db = Db::getConnection();

		$sql = "DELETE FROM uchastki WHERE id = :id";

		// Получение и возврат результатов. Используется подготовленный запрос
		$result = $db->prepare($sql);
		$result->bindParam(':id', $id, PDO::PARAM_INT);
		return $result->execute();
	}
}