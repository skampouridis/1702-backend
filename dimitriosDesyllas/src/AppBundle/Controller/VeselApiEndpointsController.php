<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Exception\EmptyParamGivenException;

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
		return $this->jsonXmlSerializeResponse($request,self::RESPONSE_JSON);
	}

	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.xml",name="getRoutesAsXml")
	 * @Method("GET")
	 */
	public function getVeselRoutesXml(Request $request)
	{
		return $this->jsonXmlSerializeResponse($request,self::RESPONSE_XML);
	}
	
	/**
	 * I developed this method because the code is similar and only a very small ammount of it changes.
	 * 
	 * @param Request $request
	 * @param unknown $whatToSerialize
	 * @return \Symfony\Component\HttpFoundation\Response
	 * 
	 */
	private function jsonXmlSerializeResponse(Request $request,$whatToSerialize)
	{
		$response=new Response();
		$response->headers->set('Content-type',$whatToSerialize);
		
		$whatFormToSerializeTheResponse=null;
		switch($whatToSerialize) {
			case self::RESPONSE_JSON:
				$whatFormToSerializeTheResponse='json';
				break;
			case self::RESPONSE_XML:
				$whatFormToSerializeTheResponse='xml';
				break;
		}
		
		try {
			$data=$this->getVeselRoutesFromDb($request);
			$serializer=$this->get('jms_serializer');
			$data=$serializer->serialize($data, $whatFormToSerializeTheResponse);
			$response->setContent($data);
		} catch(EmptyParamGivenException $ep) {
			$response->setStatusCode(Response::HTTP_BAD_REQUEST);
			$response->setContent(json_encode(['message'=>$ep->getMessage()]));
		} catch(\Exception $e) {
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
			$response->setContent(json_encode(['message'=>$e->getMessage()]));
		}
		
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
		$response->headers->set('Content-type',self::RESPONSE_CSV);
		
		try {
			$data=$this->getVeselRoutesFromDb($request);
			$csvContent=$this->get('twig')->render('routes/routes.csv.twig',['vesels'=>$data]);
			$response->setContent($csvContent);
		} catch(EmptyParamGivenException $ep) {
			$response->setStatusCode(Response::HTTP_BAD_REQUEST);
			$response->setContent($ep->getMessage());
		} catch(\Exception $e) {
			$response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
			$response->setContent($e->getMessage());
		}
		
		return $response;
	}
	
	
	/**
	 * Calls the repository (that has the role of the mvc MODEL) and returns the data.
	 * 
	 * I seperated the model call with the other route functions
	 * because I wanted to have more clean code and reusable one.
	 * 
	 * @return void
	 * @throws EmptyParamGivenException
	 * @throws Exception
	 * 
	 * @return Vesel[]
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
