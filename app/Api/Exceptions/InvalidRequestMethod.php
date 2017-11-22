<?php

namespace App\Api\Exceptions;

use App\Api\ApiLogger;

/**
 * Class InvalidRequestMethod
 *
 * This exception returned when a user sends an invalid HTTP method
 *
 * @package App\Api\Exceptions
 */
class InvalidRequestMethod extends ApiException
{
    /**
     * The message of the exception
     *
     * @var string
     */
    protected $message = 'Not valid request method';

    /**
     * The general code of the exception
     *
     * @var string
     */
    protected $code = 500;

    /**
     * The code of the exception for our API.
     *
     * @var int
     */
    protected $api_code = 1001;

    /**
     * The render method
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