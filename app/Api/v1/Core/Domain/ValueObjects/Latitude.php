<?php

namespace App\Api\v1\Core\Domain\ValueObjects;

use App\Api\Exceptions\InvalidValueObject;

/**
 * Class Latitude
 *
 * Value object for latitude
 *
 * @package App\Api\v1\Core\Domain\ValueObjects
 */
final class Latitude extends NativeType
{
    protected $regex = "/^(\+|-)?(?:90(?:(?:\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\.[0-9]{1,6})?))$/";

    /**
     * Latitude constructor.
     *
     * @param $latitude
     */
    public function __construct($latitude)
    {
        $this->value = $latitude;
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
            throw new InvalidValueObject(sprintf('%s is not a valid latitude', $this->value));
        }
    }
}