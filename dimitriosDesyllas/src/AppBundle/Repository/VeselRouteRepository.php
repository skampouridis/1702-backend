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


		if(!empty($longituteMin)){
			$query->andWhere('m.logtitude >= :long_min')->setParameter(':long_min',$longituteMin);
		}

		if(!empty($longtitudeMax)) {
			$query->andWhere('m.logtitude <= :long_max')->setParameter(':long_max',$longituteMax);
		}

		if(!empty($latitudeMin)){
						$query->andWhere('m.latitude >= :lat_min')->setParameter(':lat_min',$latitudeMin);
		}

		if(!empty($latitudeMax)){
						$query->andWhere('m.latitude <= :lat_max')->setParameter(':lat_max',$latitudeMin);
		}

		if(!empty($mmsids)){
			$query->andWhere('v.mmsi IN (:mmsids)')->setParameter('mmsids', $mmsids,\Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
		}

		$paramsToValidate=[RouteInputParameter::PARAM_DATE_FROM=>$fromDate,RouteInputParameter::PARAM_DATE_TO=>$toDate];
		if($fromDate!==null && $toDate!==null){
			InputValidator::dateRangeValidation($paramsToValidate,RouteInputParameter::PARAM_DATE_FROM,RouteInputParameter::PARAM_DATE_TO);
			$query->andWhere('m.timestamp BETWEEN :date_min AND :date_max')
				->setParameters(['date_min'=>$fromDate,'date_max'=>$toDate]);
		} else if($fromDate!==null) {
			$query->andWhere('m.timestamp <= :date_min')
				->setParameters(['date_min'=>$fromDate]);
		} else if($toDate!==null) {
			$query->where('m.timestamp >= :date_max')
				->setParameters(['date_max'=>$toDate]);
		}

		$query = $query->getQuery();
		return $query->getResult();
	}
}
