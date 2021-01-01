<?php
# Отображение страниц сайта
class SiteController
{
	public $userRole;

	public function __construct()
	{
		$this->userRole = User::userRole();
	}

	// Action для главной страницы
	public function actionIndex()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		require_once(ROOT.'/views/site/index.php');

		return true;
	}

	// Action для страницы "Расписание маршруток"
	public function actionBuses()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		require_once(ROOT.'/views/site/buses.php');

		return true;
	}

	// Action для страницы расписания поливов
	public function actionPoliv()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		require_once(ROOT.'/views/site/poliv.php');

		return true;
	}

	// Action для страницы с тарифами
	public function actionTarif()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		require_once(ROOT.'/views/site/tarif.php');

		return true;
	}

	// Action для страницы с графиком работы админ здания
	public function actionGrafik()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		require_once(ROOT.'/views/site/grafik.php');

		return true;
	}

	// Action для страницы контактов
	public function actionContacts()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список всех контактов
		$contacts = Contacts::getAllContacts();

		require_once(ROOT.'/views/site/contacts.php');

		return true;
	}

	// Action для страницы с участками
	public function actionUchastki()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список всех участков
		$uchastki = Uchastki::getAllUchastki();

		// Данные приватизированных участков
		$uchastkiPrivat = Uchastki::getPrivatUchastki();

		// Данные НЕприватизированных участков
		$uchastkiNotPrivat = Uchastki::getNotPrivatUchastki();

		// Получаем количество всех участков
        $uchastkiCount = Uchastki::getUchastkiCount();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/uchastki.php');
			return true;
		} else {
			header("Location: /user/login");
		}

	}

	// Action для страницы с приватизированными участками
	public function actionPrivatUchastki()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список приватизированных участков
		$allUchastkiPrivat = Uchastki::getAllPrivatUchastki();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/uchastki_privat.php');
			return true;
		} else {
			header("Location: /user/login");
		}

	}

	// Action для страницы с приватизированными участками
	public function actionNotPrivatUchastki()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список приватизированных участков
		$uchastkiAllNotPrivat = Uchastki::getAllNotPrivatUchastki();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/uchastki_not_privat.php');
			return true;
		} else {
			header("Location: /user/login");
		}

	}

	// Action для страницы с садоводами
	public function actionSadovods()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список всех садоводов
		$sadovods = Sadovods::getAllSadovods();

		// Количество садоводов
		$countUsers = Sadovods::getCountSadovods();

		// Количество садоводов, живущих в СВТ
		$countUsersSvt = Sadovods::getCountSadovodsSvt();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/sadovods.php');
			return true;
		} else {
			header("Location: /user/login");
		}
	}

	// Action для страницы с садоводами, живущими в СВТ
	public function actionSadovodsSvt()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список садоводов, живущих в СВТ
		$usersSvt = Sadovods::getSadovodsSvt();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/sadovods_svt.php');
			return true;
		} else {
			header("Location: /user/login");
		}
	}

	// Action для страницы с показаниями электросчётчиков
	public function actionElectro()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Данные по показаниям электросчётчиков
		$electroAll = Electro::getAllElectro();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/electro.php');
			return true;
		} else {
			header("Location: /user/login");
		}

	}

	// Action для страницы с должниками
	public function actionDolgi()
	{
		// Определение роли юзера
		$userRole = $this->userRole;

		// Список всех участков
		$uchastki = Uchastki::getAllUchastki();

		// Список долгов по всем участкам
		$dolgi = Dolgi::getAllDolgi();

		echo '<pre>';
		print_r($dolgi);

		// Данные по показаниям электросчётчиков
		//$electroAll = Electro::getAllElectro();

		// Допуск по роли юзера
		if ($userRole == 'admin' || $userRole == 'pravlenie') {
			require_once(ROOT.'/views/site/dolgi.php');
			return true;
		} else {
			header("Location: /user/login");
		}

	}
}
