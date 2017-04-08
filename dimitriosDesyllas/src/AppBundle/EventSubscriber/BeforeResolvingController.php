<?php
namespace AppBundle\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class BeforeResolvingController implements EventSubscriberInterface
{
	/**
	 * @var string
	 */
	private $env;

	public function __construct($env)
	{
		$this->env = $env;
	}

	public static function getSubscribedEvents()
	{
		// return the subscribed events, their methods and priorities
		return array(
				KernelEvents::REQUEST => array(
						array('removeXdebugParametersWhenDev', 0),
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

	public function logVisit()
	{

	}
}
