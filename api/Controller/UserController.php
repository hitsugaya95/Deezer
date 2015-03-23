<?php

namespace Deezer\Api\Controller;

require_once 'AbstractController.php';

/**
 * User Controller
 * Retrieve a user and his favorite list
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class UserController extends \Deezer\Api\Controller\AbstractController
{
	/**
	 * Retrieve a user by his id
	 *
	 * @param integer $id
	 */
	public function show($id)
	{
		$user = $this->repositories['user']->find($id);

		if (false === $user) {
			return $this->jsonResponse("User {$id} doesn't exist", 400);
		}

		return $this->jsonResponse($user->toArray(), 200);
	}

	/**
	 * Retrieve a favorite user song list
	 *
	 * @param integer $userId
	 */
	public function favorites($userId)
	{
		$favoritesObject = $this->repositories['user']->findFavorites($userId);

		$favorites = [];
		foreach ($favoritesObject as $favorite) {
			$favorites[] = $favorite->toArray();
		}

		return $this->jsonResponse(array_values($favorites), 200);
	}
}