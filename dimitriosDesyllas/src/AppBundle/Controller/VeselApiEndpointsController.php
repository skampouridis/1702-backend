<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Exception\EmptyParamGivenException;
use AppBundle\Exception\ApiEndpointException;

class VeselApiEndpointsController extends Controller
{
	const RESPONSE_XML='application/xml';
	const RESPONSE_CSV='text/csv';
	const RESPONSE_JSON='application/json';

	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.json",name="getRoutesAsJson")
	 * @Method("GET")
	 */
	public function getVeselRoutesJson(Request $request)
	{
		return $this->getApiResponse($request,self::RESPONSE_JSON);
	}

	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.xml",name="getRoutesAsXml")
	 * @Method("GET")
	 */
	public function getVeselRoutesXml(Request $request)
	{
		return $this->getApiResponse($request,self::RESPONSE_XML);
	}

	/**
	 * Fetch all ship routes as json
	 * @Route("/routes.csv",name="getRoutesAsCsv")
	 * @Method("GET")
	 */
	public function getVeselRoutesCsv(Request $request)
	{
		return $this->getApiResponse($request,self::RESPONSE_CSV);
	}

	/**
	 * I developed this method because the code is similar and only a very small ammount of it changes.
	 *
	 * @param Request $request
	 * @param unknown $whatToSerialize
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 */
	private function getApiResponse(Request $request,$whatToSerialize)
	{
		$response=new Response();
		$response->headers->set('Content-type',$whatToSerialize);

		$whatToSerialize=explode('/',$whatToSerialize);
		$whatToSerialize=end($whatToSerialize);
		$response->setContent($whatToSerialize);

		//The return result
		$data=null;

		try {
			$data=$this->getVeselRoutesFromDb($request);
			if($whatToSerialize==='csv')//Only CSV will be displayed differently
			{
				$data=$this->get('twig')->render('routes/routes.csv.twig',['vesels'=>$data]);
			} else {
				$serializer=$this->get('jms_serializer');
				$data=$serializer->serialize($data, $whatToSerialize);
			}
		} catch(EmptyParamGivenException $ep) {
			throw new ApiEndpointException($ep->getMessage(),$response->headers->all(),Response::HTTP_BAD_REQUEST,$whatToSerialize);
		} catch(\Exception $e) {
			throw new ApiEndpointException($e->getMessage(),$response->headers->all(),Response::HTTP_INTERNAL_SERVER_ERROR,$whatToSerialize);
		}

		$response->setContent($data);
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
		$veselMMSID=$request->get('mmsi');

		if(is_string($veselMMSID)){
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
