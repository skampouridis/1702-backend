<?php
namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Monolog\Logger;
use AppBundle\Services\AllowIpToCallEndpoint;
class BeforeResolvingController implements EventSubscriberInterface
{
	/**
	 * @var string
	 */
	private $env;

	/**
	 * @var Logger
	 */
	private $log;
	
	/**
	 * @var AllowIpToCallEndpoint
	 */
	private $allowIpPolicy;

	public function __construct($env, Logger $log,AllowIpToCallEndpoint $allowIpPolicy)
	{
		$this->env = $env;
		$this->log = $log;
		$this->allowIpPolicy=$allowIpPolicy;
	}

	public static function getSubscribedEvents()
	{
		// return the subscribed events, their methods and priorities
		return array(
				KernelEvents::REQUEST => array(
						array('removeXdebugParametersWhenDev', 5),
						array('logVisit',4),
						array('limitVisitor',0)
				),
		);
	}

	public function removeXdebugParametersWhenDev(GetResponseEvent $event)
	{
		/**
		 * Because on our endpoints we have check for extra parameters we do not want any XDEBUG related param 
		 * to conflict with our checks.
		 */
		if($this->env=='dev'){
			/**
			 * @var Symfony\Component\HttpFoundation\Request
			 */
			$request= $event->getRequest();
			$request->query->remove('XDEBUG_SESSION_START');
			$request->query->remove('XDEBUG_SESSION_STOP');
		}
	}

	public function logVisit(GetResponseEvent $event)
	{
		$request= $event->getRequest();
		$urlInfo=sprintf("%s %s: %s %s",$request->server->get("REMOTE_ADDR"),$request->getMethod() , $request->server->get('SERVER_PROTOCOL'), $request->getRequestUri());
		$this->log->info($urlInfo);
	}

	public function limitVisitor(GetResponseEvent $event)
	{
		$request=$event->getRequest();
		$ip=$request->server->get("REMOTE_ADDR");
		if(!$this->allowIpPolicy->applyPolicy($ip)) {
			$response=new Response(json_encode(['message'=>"You can only have 10 requests per hour from this ip"]),Response::HTTP_TOO_MANY_REQUESTS);
			$response->headers->set('Content-Type','application/json');
			$event->setResponse($response);
		}
	}

}
