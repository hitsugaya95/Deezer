<?php

namespace Deezer\Api\Repository;

/**
 * Abstract Repository.
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
abstract class AbstractRepository
{
	protected $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
}