<?php

namespace Deezer\Api\Controller;

/**
 * Abstract controller
 *
 * @author Jimmy Phimmasone <jimmy.phimmasone@gmail.com>
 */
abstract class AbstractController
{
	protected $repositories;

    /**
     * @return array repositories
     */
	public function __construct($repositories)
	{
		$this->repositories = $repositories;
	}

	/**
     * Output a JSON based reponse to the client.
     *
     * @param mixed   $data       Data to output
     * @param integer $statusCode A valid status code
     */
    public function jsonResponse($data = null, $statusCode = 200)
    {
        $responseData = json_encode($data);
        http_response_code(((int) $statusCode));
        header('Content-type: application/json');
        echo $responseData;
    }
}