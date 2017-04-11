<?php

namespace AppBundle\Exception;

class NoDataReturendException extends \Exception {

	public function __construct(){
		parent::__construct("The are no data for this resource. Please try another resource or with another parameters.");
	}
}