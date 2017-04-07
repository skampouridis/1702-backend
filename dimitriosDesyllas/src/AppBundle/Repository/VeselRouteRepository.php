<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Helpers\InputValidator;
use \DateTime;
use AppBundle\Constants\RouteInputParameter;

class VeselRouteRepository extends EntityRepository
{

	/**
	 * @param array $mmsids
	 * @param unknown $longituteMin
	 * @param unknown $longtitudeMax
	 * @param unknown $latitudeMin
	 * @param unknown $latitudeMax
	 * @param \Datetime $timeInterval
	 *
	 * @throws EmptyParamGivenException
	 * @throws Exception
	 *
	 * @return Vesel[] with their routes
	 */
	public function getRoutes(array $mmsids=[],
									$longituteMin=null,
									$longtitudeMax=null,
									$latitudeMin=null,
									$latitudeMax=null,
									\DateTime $fromDate=null,
									\DateTime $toDate=null
	) {
		$em=$this->getEntityManager();

		$query=$em->createQueryBuilder('v')
				->from('AppBundle:Vesel', 'v')
				->innerJoin('v.veselMoveStatuses','m')
				->select('v')
				->orderBy('v.mmsi','ASC')
				->orderBy('m.timestamp','ASC');

		$paramsToValidate=[
												RouteInputParameter::PARAM_LONGTITUDE_MIN=>$longituteMin,
												RouteInputParameter::PARAM_LONGTITUDE_MAX=>$longtitudeMax,
												RouteInputParameter::PARAM_LATITUDE_MIN=>$latitudeMin,
												RouteInputParameter::PARAM_LATITUDE_MAX=>$latitudeMax
											];
		if(InputValidator::allParamsEmptyOrNoEmptyCheck($paramsToValidate)){
			$query->where("m.logtitude BETWEEN :long_min AND :long_max")
				->andWhere("m.latitude BETWEEN :lat_min AND :lat_max")
				->setParameters(['long_min'=>$longituteMin,'long_max'=>$longtitudeMax,'lat_min'=>$latitudeMin,'lat_max'=>$latitudeMax]);
		}

		if(!empty($mmsids)){
			$query->andWhere('v.mmsi IN (:mmsids)')->setParameter('mmsids', $mmsids,\Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
		}

		$paramsToValidate=[RouteInputParameter::PARAM_DATE_FROM=>$fromDate,RouteInputParameter::PARAM_DATE_TO=>$toDate];
		if(!empty($fromDate) && !empty($toDate)){
			InputValidator::dateRangeValidation($paramsToValidate,RouteInputParameter::PARAM_DATE_FROM,RouteInputParameter::PARAM_DATE_TO);
			$query->andWhere('m.timestamp BETWEEN :date_min AND :date_max')
				->setParameters(['date_min'=>$fromDate,'date_max'=>$toDate]);
		} else if(!empty($fromDate)) {
			$query->andWhere('m.timestamp <= :date_min')
				->setParameters(['date_min'=>$fromDate]);
		} else if(!empty($toDate)) {
			$query->where('m.timestamp >= :date_max')
				->setParameters(['date_max'=>$toDate]);
		}
		
		$query = $query->getQuery();
		return $query->getResult();
	}
}
