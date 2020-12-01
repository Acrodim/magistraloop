<?php

// Роутинг
class Router
{
	private $routes;

	public function __construct()
	{
		$routesPath = ROOT . '/config/routes.php';
		$this->routes = include($routesPath);
	}

	// Возвращаем строку запроса
	private function getUri()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return trim($_SERVER['REQUEST_URI'], '/');
		}
	}

	public function run()
	{
		// Получить строку запроса
		
		$uri = $this->getUri();

		// Проверить наличие такого запроса в routes.php
		foreach ($this->routes as $uriPattern => $path) {

			// Сравниваем $uriPattern и $uri
			if (preg_match("~$uriPattern~", $uri)) {

				// Получаем внутренний путь из внешнего согласно правилу
				$internalRoute = preg_replace("~$uriPattern~", $path, $uri);
	
				// Если есть совпадение, определить какой контроллер и экшин обрабатывают запрос
				$segments = explode('/', $internalRoute);

				$controllerName = array_shift($segments) . 'Controller';
				$controllerName = ucfirst($controllerName);

				$actionName = 'action' . ucfirst(array_shift($segments));

				$parameters = $segments;
		
				// Подключить файл класса-контроллера
				$controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

				if (file_exists($controllerFile)) {
					include_once($controllerFile);
			
				    $controllerObject = new $controllerName;
				    if (method_exists($controllerObject, $actionName)) {
				         $result = call_user_func_array(array($controllerObject, $actionName), $parameters);
				    } else {
				    	$userRole = User::userRole();
				        require_once(ROOT . '/views/site/404.php');
				    }
				} else {
					$userRole = User::userRole();
					require_once(ROOT . '/views/site/404.php');
				}

				if (isset($result) AND $result != null) {
					break;
				}
			}
		}
	} 
}