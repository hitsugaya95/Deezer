<?php

namespace Deezer\Api;

require_once 'Controller/ControllerProvider.php';
require_once 'Repository/UserRepository.php';
require_once 'Repository/SongRepository.php';
require_once 'Repository/FavoriteRepository.php';

use Deezer\Api\Controller\ControllerProvider;

/**
 * Load logic controllers, routes and repositories.
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class Application
{
	private $rootDir;
	private $route;

	/**
	 * The PDO object
	 */
	protected $pdo;

	/**
	 * The Controller Provider
	 */
	protected $controllerProvider;

	/**
	 * Store all repositories
	 */
	protected $repositories=[];

	/**
	 * Specified the application root directory
	 */
	public function __construct($rootDir)
	{
		$this->rootDir = realpath($rootDir);
	}

	/**
	 * Run the application
	 *
	 */
	public function run()
	{
		// Launch all dependencies
		$this->boot();

		// Route requested
		$this->route();
	}	

	/**
	 * Launch all dependencies
	 *
	 */
	private function boot()
	{
		$this->registerDatabase();
		$this->registerRoute();
		$this->registerRepositories();
		$this->registerControllerProvider();
	}	

	/**
	 * Register database configuration
	 *
	 */
	private function registerDatabase()
	{
		$dbFile = $this->rootDir.'/Config/db.conf';
		$dbOptions = parse_ini_file($dbFile);

		$this->pdo = new \PDO($dbOptions['dsn'], $dbOptions['username'], $dbOptions['password']);
	}

	/**
	 * Register route configuration
	 *
	 */
	private function registerRoute()
	{
		$routeFile = $this->rootDir.'/Config/route.conf';
		$this->route = parse_ini_file($routeFile, true);
	}

	/**
	 * Register repositories
	 *
	 */
	private function registerRepositories()
	{
		$this->repositories['user'] = new \Deezer\Api\Repository\UserRepository($this->pdo);
		$this->repositories['song'] = new \Deezer\Api\Repository\SongRepository($this->pdo);
		$this->repositories['favorite'] = new \Deezer\Api\Repository\FavoriteRepository($this->pdo);
	}

	/**
	 * Register Controller Provider
	 */
	private function registerControllerProvider()
	{
		$this->controllerProvider = new ControllerProvider($this->pdo, $this->repositories);
	}

	/**
	 * Get Requested route
	 */
	private function route()
	{
		$uri = $_SERVER['REQUEST_URI'];
		$uriPattern = explode('/', trim($uri, "/"));

		$routeMatched = false;
		$allowedMethod = [];
		foreach ($this->route as $routeName => $route) {
			$routePattern = explode('/', trim($route['location'], "/"));

			if (count($routePattern) !== count($uriPattern)) {
				continue;
			}

			foreach ($routePattern as $key => $pattern) {
				if (':params' === $pattern) {
					continue;
				}

				if ($pattern !== $uriPattern[$key]) {
					continue(2);
				}
			}

			if ($route['method'] !== $_SERVER['REQUEST_METHOD']) {
				$allowedMethod[] = $route['method'];
				continue;
			}

			$controller = $this->controllerProvider->get($route['controller']);

			if (isset($route['params'])) {
				if ($route['params'] > 1) {
					$controller->$route['action']($uriPattern[1], $uriPattern[3]);
				} else {
					$controller->$route['action']($uriPattern[1]);
				}
			} else {
				$controller->$route['action']();
			}

			$routeMatched = true;
			break;
		}

		if (!empty($allowedMethod) && false === $routeMatched) {
			$allowedMethod = implode($allowedMethod, ',');
			$responseData = json_encode("Method not allowed for {$_SERVER['REQUEST_METHOD']} only with method {$allowedMethod}");
			http_response_code(405);
			header('Content-type: application/json');
			echo $responseData;
		} elseif (false === $routeMatched) {
			$responseData = json_encode("No route found for uri : '{$uri}'");
			http_response_code(404);
			header('Content-type: application/json');
			echo $responseData;
		}
	}
}