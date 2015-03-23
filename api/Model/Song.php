<?php

namespace Deezer\Api\Model;

require_once 'AbstractModel.php';

/**
 * Song Model.
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
class Song extends \Deezer\Api\Model\AbstractModel
{
	protected $id;
	protected $title;
	protected $duration;

	public function getId()
	{
		return $this->id;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	public function getDuration()
	{
		return $this->duration;
	}

	public function setDuration($duration)
	{
		$this->duration = $duration;
		
		return $this;
	}
}