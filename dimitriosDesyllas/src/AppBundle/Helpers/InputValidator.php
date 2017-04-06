<?php 

namespace AppBundle\Helpers;

use AppBundle\Exception\EmptyParamGivenException;

class InputValidator
{
	/**
	 * 
	 * @param unknown $longitute_min
	 * @param unknown $longtitude_max
	 * @param unknown $latitude_min
	 * @param unknown $latitude_max
	 * @throws EmptyParamGivenException
	 * @return boolean true if all params given else false 
	 */
	public static function validateCoordinatesRange($longitute_min=null,$longtitude_max=null,$latitude_min=null,$latitude_max=null)
	{
		if(
				!empty($longitute_min)&&
				!empty($longtitude_max)&&
				!empty($latitude_min)&&
				!empty($latitude_max)
		){
			return true;
		} else if(	empty($longitute_min)&&
				!empty($longtitude_max)&&
				!empty($latitude_min)&&
				!empty($latitude_max)
		) {
			throw new EmptyParamGivenException('long_min');
		} elseif(
						!empty($longitute_min)&&
						empty($longtitude_max)&&
						!empty($latitude_min)&&
						!empty($latitude_max)
		) {
			throw new EmptyParamGivenException('long_max');
		} elseif(
						!empty($longitute_min)&&
						!empty($longtitude_max)&&
						empty($latitude_min)&&
						!empty($latitude_max)
		){
			throw new EmptyParamGivenException('lat_min');
		} elseif(
						!empty($longitute_min)&&
						!empty($longtitude_max)&&
						!empty($latitude_min)&&
						empty($latitude_max)
		){
			throw new EmptyParamGivenException('lat_max');
		}
		
		return false;
	}
}