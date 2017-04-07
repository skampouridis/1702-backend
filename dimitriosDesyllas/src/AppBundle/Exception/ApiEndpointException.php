<?php
namespace AppBundle\Exception;

use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

/**
 * Exception that is used by The Exception Listener in order to format and preview the 
 * error message in the correct form
 * @author pcmagas
 *
 */
class ApiEndpointException extends \Exception implements HttpExceptionInterface
{
	
	/**
	 * @var integer
	 */
	private $statusCode=null;
	
	/**
	 * @var array
	 */
	private $headers=null;
	
	/**
	 * @var string
	 */
	private $dataFormat=null;
	
	/**
	 * @param string $message
	 * @param array $headers
	 * @param string $statusCode
	 * @param string $dataFormat We used this variable in order to specify the way that data will be viewed
	 */
	public function __construct($message, array $headers,$statusCode,$dataFormat)
	{
		parent::__construct($message);	
		
		$this->statusCode=$statusCode;
		$this->headers=$headers;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface::getStatusCode()
	 */
	public function getStatusCode() {
		return $this->statusCode;
	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\HttpKernel\Exception\HttpExceptionInterface::getHeaders()
	 */
	public function getHeaders() {
		return $this->headers;
	}

}