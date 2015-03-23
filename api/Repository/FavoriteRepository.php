<?php

namespace Deezer\Api\Repository;

require_once 'AbstractRepository.php';

/**
 * Favorite Repository.
 * Retrieve, add and destroy a favorite list
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class FavoriteRepository extends \Deezer\Api\Repository\AbstractRepository
{
	/**
	 * Retrieve a favorite list
	 *
	 * @param integer $userId
	 * @param integer $songId
	 *
	 * @return array
	 */
	public function find($userId, $songId)
	{
		$sql = 
<<<_
SELECT * FROM favorites_song 
WHERE user_id = :userId 
AND song_id = :songId
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
		$statement->bindParam(':songId', $songId, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * Create a favorite list with userId and songId
	 *
	 * @param integer $userId
	 * @param integer $songId
	 *
	 * @return boolean
	 */
	public function add($userId, $songId)
	{
		$sql = 
<<<_
INSERT INTO favorites_song VALUES (:userId, :songId)
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
		$statement->bindParam(':songId', $songId, \PDO::PARAM_INT);

		return $statement->execute();
	}

	/**
	 * Destroy a favorite list with userId and songId
	 *
	 * @param integer $userId
	 * @param integer $songId
	 *
	 * @return boolean
	 */
	public function destroy($userId, $songId)
	{
		$sql = 
<<<_
DELETE FROM favorites_song
WHERE user_id = :userId
AND song_id = :songId
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':userId', $userId, \PDO::PARAM_INT);
		$statement->bindParam(':songId', $songId, \PDO::PARAM_INT);

		return $statement->execute();
	}
}