<?php

namespace App\Api\v1\Core\Domain\ValueObjects;

/**
 * Class NativeType
 *
 * The class that all value objects extend.
 *
 * @package App\Api\Core\Domain\ValueObjects
 */
class NativeType implements ValueObject
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * Named constructor to instantiate a Value Object
     *
     * @param $value
     * @return static
     */
    public static function fromNative($value)
    {
        return new static($value);
    }

    /**
     * Returns the raw $value
     *
     * @return mixed
     */
    public function getNativeValue() {
        return $this->value;
    }


}