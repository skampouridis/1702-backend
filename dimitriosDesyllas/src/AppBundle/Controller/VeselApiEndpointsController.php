<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Component\HttpFoundation\Response;

class VeselApiEndpointsController extends Controller
{
	/**
	 * Fetch all ship routes
	 * @Route("/routes/{format}",name="getRoutes")
	 * @Method("GET")
	 */
	public function getVeselRoutes()
	{
		$repository=$this->get('vesel_repository');	
		return new Response("Hello");
	}
	
	
}
