<?php

namespace Deezer\Api\Controller;

require_once 'UserController.php';
require_once 'SongController.php';
require_once 'FavoriteController.php';

/**
 * Controller Provider.
 * Retrieve controller class
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class ControllerProvider
{
	protected $pdo;
	protected $repositories;

	/**
	 * @param string $pdo
	 * @return array repositories
	 */
	public function __construct($pdo, $repositories)
	{
		$this->pdo = $pdo;
		$this->repositories = $repositories;
	}

	/**
	 * Retrieve controller class.
	 *
	 * @param string $controllerName
	 *
	 * @return AbstractController object
	 */
	public function get($controllerName)
	{
		$class = 'Deezer\Api\Controller\\'.ucfirst($controllerName).'Controller';

		return new $class($this->repositories);
	}
}