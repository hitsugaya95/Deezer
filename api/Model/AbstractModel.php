<?php

namespace Deezer\Api\Model;

/**
 * Abstract Model.
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
abstract class AbstractModel
{
	/**
	 * Return an object to an array
	 *
	 * @return array
	 */
	public function toArray()
	{
		return get_object_vars($this);
	}
}