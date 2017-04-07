<?php

namespace AppBundle\Exception;

class InvalidRangeException extends \Exception{
	public function __construct($paramNameThatShouldBeBigger,$paramNameThatShouldBeSmaller){
		parent::__construct("Param $paramNameThatShouldBeBigger must be bigger than $paramNameThatShouldBeSmaller");
	}
}