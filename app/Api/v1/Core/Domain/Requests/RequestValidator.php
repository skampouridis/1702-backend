<?php
namespace App\Api\v1\Core\Domain\Requests;

/**
 * Interface RequestValidator
 *
 * The methods that all Requests Classes in the Domain layer will implement.
 *
 * @package App\Api\v1\Core\Domain\Requests
 */
interface RequestValidator
{
    function validate();

    function result();
}
