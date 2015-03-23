<?php

namespace Deezer\Api\Repository;

require_once 'AbstractRepository.php';
require_once 'Model/User.php';
require_once 'Model/Song.php';

/**
 * User Repository.
 * Retrieve a song and a favorite song list
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class UserRepository extends \Deezer\Api\Repository\AbstractRepository
{
	/**
	 * Retrieve a user
	 *
	 * @param integer $id
	 *
	 * @return object
	 */
	public function find($id)
	{
		$sql = 
<<<_
SELECT * FROM user
WHERE id = :id
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchObject('Deezer\Api\Model\User');
	}

	/**
	 * Retrieve a favorite song list
	 *
	 * @param integer $id
	 *
	 * @return object
	 */
	public function findFavorites($id)
	{
		$sql = 
<<<_
SELECT s.id, s.title, s.duration FROM song s
LEFT JOIN favorites_song f ON f.song_id = s.id
WHERE f.user_id = :id
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchAll(\PDO::FETCH_CLASS, 'Deezer\Api\Model\Song');
	}
}