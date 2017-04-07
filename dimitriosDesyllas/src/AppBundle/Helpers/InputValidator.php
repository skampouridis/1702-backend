<?php

namespace AppBundle\Helpers;

use AppBundle\Exception\EmptyParamGivenException;
use AppBundle\Exception\InvalidRangeException;
use AppBundle\Exception\ParamHasInvalidFormatException;

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

	/**
	 * @param array $dateTimeParams
	 * @param string $fromDateParamName
	 * @param string $toDateParamName
	 */
	public static function dateRangeValidation(array $dateTimeParams,$fromDateParamName,$toDateParamName)
	{	
		$fromDate=$dateTimeParams[$fromDateParamName];
		$toDate=$dateTimeParams[$toDateParamName];
		if($fromDate->format('U')<$toDate->format('U')){
			throw new InvalidRangeException($fromDateParamName, $toDateParamName);
		}
		
	}
	
	/**
	 * @param string $dateString
	 * @return DateTime
	 * @throws ParamHasInvalidFormatException
	 */
	public static function dateInputValidateAndFormat($dateString,$paramName)
	{
		$dateTime=null;
		
		if(!empty($dateString)){
			try{			
				$dateTime=\DateTime::createFromFormat('Y/m/d H:i', $dateString);			
			} catch (Exception $e) {
				throw new ParamHasInvalidFormatException($paramName, "date in Y/m/d H:i format");
			}
		}
		
		return $dateTime;
	}
}
