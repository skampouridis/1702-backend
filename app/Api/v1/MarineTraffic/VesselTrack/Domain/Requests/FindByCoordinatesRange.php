<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests;

use App\Api\Exceptions\InvalidRequestParameter;
use App\Api\v1\Core\Domain\Requests\RequestValidator;
use App\Api\v1\Core\Domain\ValueObjects\Latitude;
use App\Api\v1\Core\Domain\ValueObjects\Longitude;

/**
 * Class FindByCoordinatesRange
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests
 */
class FindByCoordinatesRange implements RequestValidator
{
    protected $from;
    protected $to;
    protected $result;

    /**
     * FindByCoordinatesRange constructor.
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
     * It validates the received coordinates format and value and sets the results in an appropriate format so that can be used in the repository.
     *
     * @return $this
     * @throws InvalidRequestParameter
     */
    public function validate()
    {
        $latPos = strpos($this->from,'lat:');
        $lonPos = strpos($this->from,'lon:');

        if($latPos === false || $lonPos === false){
            throw new InvalidRequestParameter('Invalid coordinates format. The format is e.g. lon:5.6lat:42.5');
        }

        $fromLonArray = explode(":",substr($this->from,0,$latPos));
        $fromLatArray = explode(":",substr($this->from,$latPos,strlen($this->from)));

        $latPos = strpos($this->to,'lat:');
        $lonPos = strpos($this->to,'lon:');

        if($latPos === false || $lonPos === false){
            throw new InvalidRequestParameter('Invalid coordinates format. The format is e.g. lon:5.6lat:42.5');
        }

        $toLonArray = explode(":",substr($this->to,0,$latPos));
        $toLatArray = explode(":",substr($this->to,$latPos,strlen($this->to)));

        $fromLon = $fromLonArray[1];
        $fromLat = $fromLatArray[1];

        $toLon = $toLonArray[1];
        $toLat = $toLatArray[1];

        //call the value objects and validate the values.
        Longitude::fromNative($fromLon);
        Longitude::fromNative($toLon);
        Latitude::fromNative($fromLat);
        Latitude::fromNative($toLat);

        $this->result = [
            "lon"=>
            [
                "from"=>$fromLon < $toLon ? $fromLon : $toLon,
                "to"=>$fromLon < $toLon ? $toLon : $fromLon,
            ],
             "lat"=>
            [
                "from"=>$fromLat < $toLat ? $fromLat : $toLat,
                "to"=>$fromLat < $toLat ? $toLat : $fromLat,
            ]
        ];

        return $this;
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