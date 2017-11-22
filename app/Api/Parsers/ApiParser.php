<?php

namespace App\Api\Parsers;

/**
 * Our Api parser class.
 *
 */
abstract class ApiParser
{
    /**
     * The array of data
     *
     * @var array
     */
    protected $data;

    /**
     * ApiParser constructor.
     *
     * The constructor
     *
     * @param array $data
     */
	public function __construct(array $data)
    {
        $this->data = $data;
    }
}