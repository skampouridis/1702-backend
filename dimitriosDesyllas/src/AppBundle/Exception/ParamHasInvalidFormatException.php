<?php

namespace AppBundle\Exception;


class ParamHasInvalidFormatException extends \Exception
{
	public function __construct($paramName,$format)
	{
		parent::__construct ("The param $paramName is not a valid $format");
	}

}