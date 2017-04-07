<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Helpers\InputValidator;
use \DateTime;

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
									\Datetime $timeInterval=null
	) {
		$em=$this->getEntityManager();
		
		$query=$em->createQueryBuilder('v')
				->from('AppBundle:Vesel', 'v')
				->innerJoin('v.veselMoveStatuses','m')
				->select('v')
				//->orderBy('v.mmsi','ASC')
				->orderBy('m.timestamp','ASC');
		
		
// 		if(InputValidator::validateCoordinatesRange($longituteMin,$longtitudeMax,$latitudeMin,$latitudeMax)){
// 			$query->where("m.long BETWEEN :long_min AND :long_max")
// 				->andWhere("m.lat BETWEEN :lat_min AND :lat_max")
// 				->setParameters(['long_min'=>$longituteMin,'long_max'=>$longtitudeMax,'lat_min'=>$latitudeMin,'lat_max'=>$latitudeMax]);
// 		}
		
// 		if(!empty($mmsids)){
// 			var_dump($mmsids);
// 			$query->andWhere('v.mmsi IN (:mmsids)')->setParameter('mmsids', $mmsids,\Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
// 		}
		
		$query = $query->getQuery();
		return $query->getResult();
	}
}