<?php

namespace Deezer\Api\Model;

require_once 'AbstractModel.php';

/**
 * User Model.
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class User extends \Deezer\Api\Model\AbstractModel
{
	protected $id;
	protected $name;
	protected $email;

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;

		return $this;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function setEmail($email)
	{
		$this->email = $email;
		
		return $this;
	}
}