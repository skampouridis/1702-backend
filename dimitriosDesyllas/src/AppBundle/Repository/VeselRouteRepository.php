<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Helpers\VeselRepositoryInputValidator;
use \DateTime;

class VeselRouteRepository extends EntityRepository
{
	
	public function getRoutesByMmsid(array $mmsids=[],
									$longitute_min=null,
									$longtitude_max=null,
									$latitude_min=null,
									$latitude_max=null,
									\Datetime $timeInterval=null
	) {
		$em=$this->getEntityManager();
		
		$query=$em->createQueryBuilder('v')
				->from('AppBundle:Vesel','v')
				->innerJoin('Appbundle:VeselMoveStatus', 'm')
				->select('v');
		
		
		if(VeselRepositoryInputValidator::validateCoordinatesRange($longitute_min,$longtitude_max,$latitude_min,$latitude_max)){
			$query->where("m.long BETWEEN :long_min AND :long_max")
				->andWhere("m.lat BETWEEN :lat_min AND :lat_max")
				->setParameters(['long_min'=>$longitute_min,'long_max'=>$longtitude_max,'lat_min'=>$latitude_min,'lat_max'=>$latitude_max]);
		}
		
		if(!empty($mmsids)){
			$query->andWhere('v.mmsid IN (:mmsids)')->setParameter('mmsids', $mmsids,\Doctrine\DBAL\Connection::PARAM_STR_ARRAY);
		}
		
	}
}