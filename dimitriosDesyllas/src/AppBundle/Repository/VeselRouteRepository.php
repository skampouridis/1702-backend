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
	 * @throws InvalidRangeException
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
				->select('v.mmsi,m.logtitude,m.latitude,m.timestamp')
				//->select('v,m')
				->addOrderBy('v.mmsi','ASC')
				->addOrderBy('m.timestamp','DESC');

		$paramsToSet=[];

		if(!empty($longituteMin) && !empty($longtitudeMax)) {
			$paramsToValidate=[RouteInputParameter::PARAM_LONGTITUDE_MIN=>$longituteMin,RouteInputParameter::PARAM_LONGTITUDE_MAX=>$longtitudeMax];
			InputValidator::compareNumericRange($paramsToValidate,RouteInputParameter::PARAM_LONGTITUDE_MIN,RouteInputParameter::PARAM_LONGTITUDE_MAX);
			$query->andWhere('m.logtitude BETWEEN :long_min AND :long_max');
			$paramsToSet["long_min"]=$longituteMin;
			$paramsToSet["long_max"]=$longtitudeMax;
	  } else if(!empty($longituteMin)) {
			$query->andWhere('m.logtitude >= :long_min');
			$paramsToSet["long_min"]=$longituteMin;
		} elseif(!empty($longtitudeMax)) {
			$query->andWhere('m.logtitude <= :long_max');
			$paramsToSet["long_max"]=$longtitudeMax;
		}



		if(!empty($latitudeMax) && !empty($latitudeMin)){
			$paramsToValidate=[RouteInputParameter::PARAM_LATITUDE_MIN=>$latitudeMin,RouteInputParameter::PARAM_LATITUDE_MAX=>$latitudeMax];
			InputValidator::compareNumericRange($paramsToValidate,RouteInputParameter::PARAM_LATITUDE_MIN,RouteInputParameter::PARAM_LATITUDE_MAX);
			$query->andWhere('m.latitude BETWEEN :lat_min AND :lat_max');
			$paramsToSet["lat_min"]=$latitudeMin;
			$paramsToSet["lat_max"]=$latitudeMax;
		}elseif(!empty($latitudeMax)){
			$query->andWhere('m.latitude <= :lat_max');//->setParameter(':lat_max',$latitudeMax);
			$paramsToSet["lat_max"]=$latitudeMax;
		} elseif(!empty($latitudeMin)) {
				$query->andWhere('m.latitude >= :lat_min');//->setParameter(':lat_min',$latitudeMin);
				$paramsToSet["lat_min"]=$latitudeMin;
		}

		if(!empty($mmsids)){
			$query->andWhere('v.mmsi IN (:mmsids)');//->setParameter(':mmsids', $mmsids,\Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
			$paramsToSet['mmsids']=implode(',',$mmsids);
		}

		$paramsToValidate=[RouteInputParameter::PARAM_DATE_FROM=>$fromDate,RouteInputParameter::PARAM_DATE_TO=>$toDate];
		if($fromDate!==null && $toDate!==null){
			InputValidator::dateRangeValidation($paramsToValidate,RouteInputParameter::PARAM_DATE_FROM,RouteInputParameter::PARAM_DATE_TO);
			$query->andWhere('m.timestamp BETWEEN :date_min AND :date_max');
				$paramsToSet['date_min']=$fromDate;
				$paramsToSet['date_max']=$toDate;
		} else if($fromDate!==null) {
			$query->andWhere('m.timestamp >= :date_min');
				$paramsToSet['date_min']=$fromDate;
		} else if($toDate!==null) {
			$query->andWhere('m.timestamp <= :date_max');
			$paramsToSet['date_max']=$toDate;
		}

		if(!empty($paramsToSet)){
			$query->setParameters($paramsToSet);
		}

		$query = $query->getQuery();
		return $query->getResult();
	}
}
