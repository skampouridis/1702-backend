<?php

namespace App\Api\Exceptions;

use App\Api\ApiLogger;

/**
 * Class InvalidValueObject
 *
 * This exception returned from value objects validator method.
 *
 * @package App\Api\Exceptions
 */
class InvalidValueObject extends ApiException
{
    /**
     * The message of the exception
     *
     * @var string
     */
    protected $message = 'Not valid value object value';

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
    protected $api_code = 1003;

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