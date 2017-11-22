<?php

namespace App\Api\Exceptions;

use App\Api\ApiLogger;


/**
 * Class InvalidApiVersion
 *
 * This exception is returned when a user sends an invalid API version through the HTTP Header api-version.
 *
 * @package App\Api\Exceptions
 */
class InvalidApiVersion extends ApiException
{

    /**
     * The message of the exception
     *
     * @var string
     */
    protected $message = 'Not valid api version';

    /**
     * The general code of the exception
     *
     * @var string
     */
    protected $code = 500;

    /**
     * The code of the exception for our API. This is for monitoring purposes
     *
     * @var int
     */
    protected $api_code = 1000;

    /**
     * The render method. It is automatically triggered by the framework itself.
     *
     * @param $request
     * @return array
     */
    public function render($request)
    {
        return [
            'status'=>"error",
            'code'=>$this->code,
            'message'=>$this->message
        ];
    }

    /**
     * Report the exception.
     */
    public function report()
    {
        ApiLogger::info($this->message);
    }
}