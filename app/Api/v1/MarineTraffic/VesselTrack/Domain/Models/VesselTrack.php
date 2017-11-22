<?php

namespace App\Api\v1\MarineTraffic\VesselTrack\Domain\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VesselTrack
 *
 * The vessel track object.
 *
 * @package App\Api\v1\MarineTraffic\VesselTrack\Domain\Models
 */
class VesselTrack extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mmsi', 'status', 'speed','lon','lat','course', 'heading','rot','timestamp'
    ];
}
