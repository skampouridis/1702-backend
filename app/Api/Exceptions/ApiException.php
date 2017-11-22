<?php

namespace App\Api\Exceptions;

/**
 * Class ApiException
 *
 * Our API general exception class
 *
 * @package App\Api\Exceptions
 */
class ApiException extends \Exception
{
    /**
     * Returns the exception code based on API pattern.
     *
     * @return mixed
     */
    public function getApiCode()
    {
        return $this->api_code;
    }

}