<?php

namespace Deezer\Api\Controller;

require_once 'AbstractController.php';

/**
 * Song Controller
 * Retrieve a song
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class SongController extends \Deezer\Api\Controller\AbstractController
{
	/**
	 * Retrieve a song by his id
	 *
	 * @param integer $id
	 */
	public function show($id)
	{
		$song = $this->repositories['song']->find($id);

		if (false === $song) {
			return $this->jsonResponse("Song {$id} doesn't exist", 400);
		}

		return $this->jsonResponse($song->toArray(), 200);
	}
}