<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class VeselApiEndpointsController extends Controller
{
	const RESPONSE_XML='application/xml';
	const RESPONSE_CSV='application/csv';
	const RESPONSE_JSON='application/json';
	
	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.json",name="getRoutesAsJson")
	 * @Method("GET")
	 */
	public function getVeselRoutesJson(Request $request)
	{
		$response=new Response();
		$response->headers->set('Content-type',self::RESPONSE_JSON);
		
		try{
			$data=$this->getVeselRoutesFromDb($request);
			$response->setContent(json_encode($data));
		} catch(EmptyParamGivenException $ep) {
			$response->setStatusCode(Response::HTTP_BAD_REQUEST);
			$response->setContent(json_encode(['message'=>$ep->getMessage()]));
		} catch(Exception $e) {
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
			$response->setContent(json_encode(['message'=>$ep->getMessage()]));
		}
		
		return $response;
	}

	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.xml",name="getRoutesAsXml")
	 * @Method("GET")
	 */
	public function getVeselRoutesXml(Request $request)
	{
		$response=new Response();
		$response->setHeader('Content-type',self::RESPONSE_XML);
		
		return $response;
	}
	
	
	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.csv",name="getRoutesAsCsv")
	 * @Method("GET")
	 */
	public function getVeselRoutesCsv(Request $request)
	{	
		$response=new Response();
		return $response;
	}
	
	
	/**
	 * Calls the repository (that has the role of the model) 
	 * and returns the data.
	 * 
	 * I seperated the model call with the other route functions
	 * because I wanted to have more clean code and reusable one.
	 * 
	 * @return void
	 * @throws 
	 * @throws Exception
	 * 
	 */
	private function getVeselRoutesFromDb(Request $request)
	{
		$veselMMSID=$request->get('mmsid');
		
		if(!is_string($veselMMSID)){
			$veselMMSID=explode(";",$veselMMSID);
		}
		
		$latitudeMin=$request->get('latitude_min');
		$latitudeMax=$request->get('latitude_max');
		$longtitudeMin=$request->get('longtitude_min');
		$longtitudeMax=$request->get('longtitude_max');
		
		$repository=$this->get('vesel_repository');
		
		$data=$repository->getRoutes($veselMMSID,$latitudeMin,$latitudeMax,$longtitudeMin,$longtitudeMax);
		
		return $data;
	}
}
