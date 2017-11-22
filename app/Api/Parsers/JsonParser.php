<?php

namespace App\Api\Parsers;

/**
 * Class JsonParser
 *
 * Returns the data in a json format.
 *
 * @package App\Api\Parsers
 */
class JsonParser extends ApiParser
{

    /**
     * Returns the output in json format
     *
     * @return string
     */
    public function parse()
    {
        //we did not use the json_encode($this->data) function.
        //The framework itself transforms the array into json response.
		return $this->data;
	}

}