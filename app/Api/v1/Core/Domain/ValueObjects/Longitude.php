<?php

namespace App\Api\v1\Core\Domain\ValueObjects;

use App\Api\Exceptions\InvalidValueObject;

/**
 * Class Longitude
 *
 * Value object for longitude
 *
 * @package App\Api\v1\Core\Domain\ValueObjects
 */
final class Longitude extends NativeType
{
     protected $regex = "/^(\+|-)?(?:180(?:(?:\.0{1,6})?)|(?:[0-9]|[1-9][0-9]|1[0-7][0-9])(?:(?:\.[0-9]{1,6})?))$/";

    /**
     * Longitude constructor.
     *
     * @param $longitude
     */
    public function __construct($longitude)
    {
        $this->value = $longitude;
        $this->validator();
    }

    /**
     * Validates the native value.
     *
     * @throws InvalidValueObject
     */
    protected function validator()
    {
        if(!preg_match($this->regex,$this->value)){
            throw new InvalidValueObject(sprintf('%s is not a valid longitude', $this->value));
        }
    }
}