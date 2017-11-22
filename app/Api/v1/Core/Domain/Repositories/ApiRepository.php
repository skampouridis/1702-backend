<?php

namespace App\Api\v1\Core\Domain\Repositories;


/**
 * Interface ApiRepository
 *
 * The general repository interface for our API
 *
 * @package App\Api\v1\Core\Domain\Repositories
 */
interface ApiRepository
{
    /**
     * It returns an empty object
     *
     * @return mixed
     */
    function newObject();

    /**
     * It fetches all objects from the database
     *
     * @param array $columns
     * @param array $hidden
     * @return mixed
     */
    function all($columns = ['*'],$hidden = null);

}