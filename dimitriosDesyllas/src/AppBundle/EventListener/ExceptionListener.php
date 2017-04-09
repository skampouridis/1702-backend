<?php 
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Exception\ApiEndpointException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

class ExceptionListener
{
	/**
	 * @var string
	 */
	private $env;
	
	public function __construct($env)
	{
		$this->env = $env;
	}
	
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = array(
        		'message'=>$exception->getMessage(),
        );
        
        if($this->env=='dev'){
        	$message['exception_class']= get_class($exception);
        	$message['code']=$exception->getCode();
        	$message['stacktrace']=$exception->getTrace();
        }
        
        // Customize your response object to display the exception details
        $response = new Response();

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
 		if ($exception instanceof ApiEndpointException) {        	
            $response->setStatusCode($exception->getStatusCode());
            $headers=$exception->getHeaders();
            if(!empty($headers)){            	
            	$response->headers->replace();
            }
 		} else if($exception instanceof MethodNotAllowedHttpException){
 			$response->setStatusCode(Response::HTTP_METHOD_NOT_ALLOWED);
    	} else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);            
        }

        $response->headers->set("Content-type","application/json");
        $response->setContent(json_encode($message));
        
        // Send the modified response object to the event
        $event->setResponse($response);
    }
}