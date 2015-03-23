<?php

namespace Deezer\Api\Controller;

require_once 'AbstractController.php';

/**
 * Favorite Controller
 * Create and delete user's favorite song
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class FavoriteController extends \Deezer\Api\Controller\AbstractController
{
	/**
	 * Add a song to favorite user's list
	 *
	 * @param integer $userId
	 */
	public function create($userId)
	{
		if (!isset($_POST['song_id'])) {
			return $this->jsonResponse("You must POST a song id", 400);
		}

		$songId = $_POST['song_id'];

		$song = $this->repositories['song']->find($songId);
		if (false === $song) {
			return $this->jsonResponse("Song id {$songId} doesn't exist", 400);
		}

		$user = $this->repositories['user']->find($userId);
		if (false === $user) {
			return $this->jsonResponse("user id {$userId} doesn't exist", 400);
		}

		$alreadyExist = $this->repositories['favorite']->find($userId, $songId);
		if (false !== $alreadyExist) {
			return $this->jsonResponse("Song id {$songId} already add in user id {$userId} favorite list", 400);
		}

		$this->repositories['favorite']->add($userId, $songId);

		return $this->jsonResponse(array(), 201);
	}

	/**
	 * Delete a song from favorite user's list
	 *
	 * @param integer $userId
	 * @param integer $songId
	 */
	public function delete($userId, $songId)
	{
		$user = $this->repositories['user']->find($userId);
		if (false === $user) {
			return $this->jsonResponse("user id {$userId} doesn't exist", 400);
		}

		$this->repositories['favorite']->destroy($userId, $songId);

		return $this->jsonResponse(array(), 204);
	}
}