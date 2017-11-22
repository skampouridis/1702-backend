<?php

namespace App\Api\v1\Core\Domain\ValueObjects;

/**
 * Interface ValueObject
 *
 * The value object contract of our API
 *
 * @package App\Api\v1\Core\Domain\ValueObjects
 */
interface ValueObject {

    /**
     * Named constructor to make a Value Object from a native value.
     *
     * @param $value
     * @return mixed
     */
    static function fromNative($value);

    /**
     * Returns the native value of this Value Object.
     *
     * @return mixed
     */
    function getNativeValue();
}