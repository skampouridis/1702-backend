<?php 
namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        // You get the exception object from the received event
        $exception = $event->getException();
        $message = array(
            'message'=>$exception->getMessage(),
            'code'=>$exception->getCode(),
        	'stacktrace'=>$exception->getTrace(),
        );

        // Customize your response object to display the exception details
        $response = new Response();
        $response->setContent(json_encode($message));

        // HttpExceptionInterface is a special type of exception that
        // holds status code and header details
        if ($exception instanceof HttpExceptionInterface) {
            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
            $response->headers->set('content/type','application/json');
        }

        // Send the modified response object to the event
        $event->setResponse($response);
    }
}