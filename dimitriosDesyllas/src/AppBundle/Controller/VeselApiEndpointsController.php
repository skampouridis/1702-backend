<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class VeselApiEndpointsController extends Controller
{
	/**
	 * Fetch all shir routes
	 * @Route("/routes/{format}",name="getRoutes")
	 * @Method GET
	 */
	public function getVeselRoutes()
	{
		
	}
	
	/**
	 * Fetch route from a specific vesel
	 * @Route("/vesel/{id}/routes/{format}",name="getRoutes")
	 * @Method GET
	 */
	public function getVeselRoutes()
	{
		
	}
}
