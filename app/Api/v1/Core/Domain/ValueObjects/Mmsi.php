<?php

namespace App\Api\v1\Core\Domain\ValueObjects;

use App\Api\Exceptions\InvalidValueObject;

/**
 * Class Mmsi
 *
 * Value object for MMSI
 *
 * @package App\Api\v1\Core\Domain\ValueObjects
 */
final class Mmsi extends NativeType
{
    /**
     * Mmsi constructor.
     *
     * Assert a new mmsi number
     *
     * @param $mmsi
     */
    public function __construct($mmsi)
    {
        $this->value = $mmsi;
        $this->validator();
    }

    /**
     * Validates the native value.
     *
     * @throws InvalidValueObject
     */
    protected function validator()
    {
        if(!$mmsi = filter_var($this->value, FILTER_VALIDATE_INT)){
            throw new InvalidValueObject(sprintf('%s is not a valid mmsi number', $this->value));
        }

        if(strlen($mmsi) != 9){
            throw new InvalidValueObject(sprintf('The mmsi %s is not a nine-digit number', $mmsi));
        }
    }
}