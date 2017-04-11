<?php 
namespace AppBundle\Exception;

class InvalidNumberOfParametersException extends \Exception
{
	public function __construct($parametersGiven,$parametersNeeded,$extraParameters="",$missingParameters="")
	{
		parent::__construct('');
		
		$message="You should have provided $parametersNeeded but you provided $parametersGiven.";
		
		if(!empty($extraParameters)){
			$message.=" The parameters [ $extraParameters ] are not needed. ";
		}
		
		if(!empty($missingParameters)){
			$message.="The parameters  [ $missingParameters ] are needed and were not provided.";
		}
		
		/**
		 * Message is a protected variable of Exception
		 */
		$this->message=$message;
	}
}