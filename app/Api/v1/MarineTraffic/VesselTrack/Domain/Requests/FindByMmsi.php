<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests;

use App\Api\Exceptions\InvalidRequestParameter;
use App\Api\v1\Core\Domain\Requests\RequestValidator;
use App\Api\v1\Core\Domain\ValueObjects\Mmsi;

/**
 * Class FindByMmsi
 *
 * The request validator class for mmsi routes.
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Domain\Requests
 */
class FindByMmsi implements RequestValidator
{
    protected $mmsi;
    protected $result;

    /**
     * FindByMmsi constructor.
     *
     * @param $mmsi
     */
    public function __construct($mmsi)
    {
        $this->mmsi = $mmsi;
    }

    /**
     * It validates the received mmsi format and value and sets the results in an appropriate format so that can be used in the repository.
     *
     * @return $this
     * @throws InvalidRequestParameter
     */
    public function validate()
    {
        $mmsiArray = explode(",",$this->mmsi);
        if(!is_array($mmsiArray)){
            throw new InvalidRequestParameter('The mmsi should be provided as it is or for multiple mmsi\'s must be separated with comma');
        }

        foreach($mmsiArray as $mmsi) {

            //value object self validated
            Mmsi::fromNative($mmsi);
        }

        $this->result = $mmsiArray;

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