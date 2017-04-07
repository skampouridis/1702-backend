<?php

namespace AppBundle\Helpers;

use AppBundle\Exception\EmptyParamGivenException;

/**
* Class that contains validation methods for input parameters
*/
class InputValidator
{

	/**
	* @param array $values as array with the parameter values.
	* @return bool True if all values Not Empty, False if all values are empty
	* @throws EmptyParamGivenException when some parameters have value and some are empty
	*/
	public static function allParamsEmptyOrNoEmptyCheck(array $values)
	{
		$valueNum=count($values);
		$emptyValues=0;
		$nonEmptyValues=0;

		$emptyParams=array();

		foreach($values as $key=>$value){
			if(empty($value))
			{
				$emptyValues++;
				$emptyParams[]=$key;
			} else {
				$nonEmptyValues++;
			}
		}

		$emptyValuesOk=($emptyValues===$valueNum);
		$nonEmptyValuesOk=($nonEmptyValues===$valueNum);

		if($emptyValuesOk || $nonEmptyValuesOk) {
				return true;
		} elseif($emptyValuesOk) {
				return false;
		} else {
			throw new EmptyParamGivenException(implode($emptyParams));
		}

	}

}
