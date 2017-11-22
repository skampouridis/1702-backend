<?php

namespace App\Api\Exceptions;

use App\Api\ApiLogger;

/**
 * Class RateLimit
 *
 * This exception returned from the RateLimit middleware when the user consumed the requests/hour restriction.
 *
 * @package App\Api\Exceptions
 */
class RateLimit extends ApiException
{
    /**
     * The message of the exception
     *
     * @var string
     */
    protected $message = 'Rate limit exceeded"';

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
    protected $api_code = 1004;

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