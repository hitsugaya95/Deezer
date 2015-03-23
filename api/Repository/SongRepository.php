<?php

namespace Deezer\Api\Repository;

require_once 'AbstractRepository.php';
require_once 'Model/Song.php';

/**
 * Song Repository.
 * Retrieve a song
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class SongRepository extends \Deezer\Api\Repository\AbstractRepository
{
	/**
	 * Retrieve a song
	 *
	 * @param integer $id
	 *
	 * @return object
	 */
	public function find($id)
	{
		$sql = 
<<<_
SELECT * FROM song
WHERE id = :id
_;

		$statement = $this->pdo->prepare($sql);
		$statement->bindParam(':id', $id, \PDO::PARAM_INT);
		$statement->execute();

		return $statement->fetchObject('Deezer\Api\Model\Song');
	}
}