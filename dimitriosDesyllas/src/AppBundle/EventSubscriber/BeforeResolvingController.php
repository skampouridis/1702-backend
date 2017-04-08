<?php
namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Monolog\Logger;

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

	public function __construct($env, Logger $log)
	{
		$this->env = $env;
		$this->log = $log;
	}

	public static function getSubscribedEvents()
	{
		// return the subscribed events, their methods and priorities
		return array(
				KernelEvents::REQUEST => array(
						array('removeXdebugParametersWhenDev', 5),
						array('logVisit',0)
				)
		);
	}

	public function removeXdebugParametersWhenDev(GetResponseEvent $event)
	{
		//When dev we do not want any Sort of url parameters that satart with XDEBUG
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
}
