<?php

namespace AppBundle\Helpers;

use AppBundle\Exception\EmptyParamGivenException;
use AppBundle\Exception\InvalidRangeException;
use AppBundle\Exception\ParamHasInvalidFormatException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Exception\InvalidNumberOfParametersException;

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
				$dateString=str_replace('/','-',$dateString);
				$dateTime=\DateTime::createFromFormat('Y-m-d H:i', $dateString);
			} catch (Exception $e) {
				throw new ParamHasInvalidFormatException($paramName, "date in Y/m/d H:i format");
			}
		}

		return $dateTime;
	}

	/**
	 * LOOK WHEN REFACTOR:
	 * If this method needs to be refactored then try moving this method to another class
	 *
	 * NOTE:
	 * This method DOES NOT look for MISSING parameters but for EXTRA ones.
	 *
	 * @param Request $request
	 * @param array $parametersThatHttpRequestShouldHave
	 * @throws InvalidNumberOfParametersException
	 */
	public static function httpRequestShouldHaveSpecificParametersWhenGiven(Request $request,array $parametersThatHttpRequestShouldHave)
	{
		$parametersToValidate=$request->query->all();

		if(empty($parametersToValidate)){
			return;
		}

		$parametersToValidate=array_keys($parametersToValidate);

		$extraParameters=array_diff($parametersToValidate,$parametersThatHttpRequestShouldHave);

		foreach($extraParameters as $param){
			if(!in_array($param,$parametersThatHttpRequestShouldHave)){
				throw new InvalidNumberOfParametersException(implode(',',$parametersToValidate),implode(',',$parametersThatHttpRequestShouldHave),$param,"");
			}
		}
	}
}
