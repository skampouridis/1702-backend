<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests;

use App\Api\Exceptions\InvalidRequestParameter;
use App\Api\v1\Core\Domain\Requests\RequestValidator;
use Carbon\Carbon;

/**
 * Class FindByTimeInterval
 *
 * The request validator class for time routes.
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests
 */
class FindByTimeInterval implements RequestValidator
{
    protected $from;
    protected $to;
    protected $result;

    /**
     * FindByTimeInterval constructor.
     *
     * @param $from
     * @param $to
     */
    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * It validates the received time format and value and sets the results in an appropriate format so that can be used in the repository.
     *
     * @return $this
     * @throws InvalidRequestParameter
     */
    public function validate()
    {
        try {

            //catch the carbon exception for a non correct timestamp format and return an API exception so that can be handled from exception handler.
            $from = Carbon::createFromTimestamp($this->from);
            $to = Carbon::createFromTimestamp($this->to);

        } catch (\ErrorException $e) {
            throw new InvalidRequestParameter('The provided timestamps are not valid. Please check your values.');
        }

        //if timestamps are correct, from is less or equal than to
        if($from->lte($to)){

            $this->result = [
                "from"=>$from->toDateTimeString(),
                "to"=>$to->toDateTimeString()
            ];

            return $this;
        }

        throw new InvalidRequestParameter('From ('.$from->toDateTimeString().') timestamp must be prior to To ('.$to->toDateTimeString().') timestamp');
    }

    /**
     * Returns the results
     *
     * @return mixed
     */
    public function result()
    {
        return $this->result;
    }
}