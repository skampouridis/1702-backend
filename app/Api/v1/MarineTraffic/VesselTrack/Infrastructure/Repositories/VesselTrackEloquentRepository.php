<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Infrastructure\Repositories;

use App\Api\v1\MarineTraffic\VesselTrack\Domain\Models\VesselTrack;
use App\Api\v1\MarineTraffic\VesselTrack\Domain\Repositories\VesselTrackRepository;

/**
 * Class VesselTrackEloquentRepository
 *
 * The repository which uses the Eloquent ORM to fetch the data.
 * The repository binding has been made through the VesselTrackProvider in the Application layer
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Infrastructure\Repositories
 */
class VesselTrackEloquentRepository implements VesselTrackRepository
{
    protected $model;

    public function __construct(VesselTrack $model)
    {
        $this->model = $model;
    }

    /**
     * Get all vessel tracks
     *
     * @param array $columns
     * @param null $hidden
     * @return $this|array
     */
    public function all($columns = ['*'],$hidden = null)
    {
        if(is_array($hidden)) {

            $results = VesselTrack::all($columns)->each(function($row) use ($hidden)
            {
                $row->setHidden($hidden);
            });

            return $results;
        }

        return VesselTrack::all($columns)->toArray();
    }

    /**
     * Get all vessel tracks by mmsi or an array of mmsis
     *
     * @param array $mmsi
     * @return mixed
     */
    public function findByMmsi(array $mmsi)
    {
        $records =  VesselTrack::whereIn('mmsi', $mmsi)->get()->toArray();

        return $records;
    }

    /**
     * Get all vessel tracks for a specific time interval
     *
     * @param array $timeInterval
     * @return mixed
     */
    public function findByTimeInterval(array $timeInterval)
    {
        $records =  VesselTrack::where('timestamp','>=', $timeInterval['from'])
            ->where('timestamp','<=', $timeInterval['to'])
            ->get()->toArray();

        return $records;
    }

    /**
     * Get all vessel tracks for a specific set of coordinates
     *
     * @param array $coordinates
     * @return mixed
     */
    public function findByCoordinatesRange(array $coordinates)
    {
         $records =  VesselTrack::whereRaw(
             "lon BETWEEN '".$coordinates["lon"]["from"]."' AND '".$coordinates["lon"]["to"]."'")
             ->whereRaw(
             "lat BETWEEN '".$coordinates["lat"]["from"]."' AND '".$coordinates["lat"]["to"]."'")
            ->get()->toArray();

        return $records;
    }

    /**
     * Get a new vessel track model.
     *
     * @return VesselTrack
     */
    public function newObject()
    {
        return new VesselTrack();
    }
}