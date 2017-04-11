<?php

namespace AppBundle\Exception;

class EmptyParamGivenException extends \Exception
{
	public function __construct($param)
	{
		parent::__construct("You have not given value to the $param param");
	}
}