<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Domain\Repositories;

use App\Api\v1\Core\Domain\Repositories\ApiRepository;

/**
 * Interface VesselTrackRepositoy
 *
 * Our Business repository interface. The methods should be implemented in the infrastructure layer from the relevant repository.
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Domain\Repositories
 */
interface VesselTrackRepository extends ApiRepository
{
    /**
     * Returns vessel track records based on the provided mmsi or a number of mmsi's
     *
     * @param array $mmsi
     * @return mixed
     */
    function findByMmsi(array $mmsi);

    /**
     * Returns vessel track records for the provided time interval.
     * The array should have two timestamps, start and end. ex: ["from"=>t,"to"=>t].
     *
     * @param array $timeInterval
     * @return mixed
     */
    function findByTimeInterval(array $timeInterval);

    /**
     * Returns vessel track records for the provided coordinates range.
     * The array should have the min,max for lon and lat. ex: ["lon"=>["from"=>50,"to"=>"120"],"lat"=>["from"=>-10,"to"=>"70"]]
     *
     * @param array $coordinates
     * @return mixed
     */
    function findByCoordinatesRange(array $coordinates);
}