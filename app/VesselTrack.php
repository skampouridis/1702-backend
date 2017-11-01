<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VesselTrack extends Model
{
    public $timestamps = false;
    public $fillable = ['vessel_id', 'status', 'speed', 'lon', 'lat', 'course','heading','rot'];

    public function vessel()
    {
        return $this->belongsTo('App\Vessel');
    }

    public function csvSerialize()
    {
//        echo "<pre>".print_r($this->vessel()->toArray(), true)."</pre>";exit();

        return [
            'vessel' => $this->vessel->mmsi,
            'status' => $this->status,
            'speed' => $this->speed,
            'lon' => $this->lon,
            'lat' => $this->lat,
            'course' => $this->course,
            'heading' => $this->heading,
            'rot' => $this->rot,
        ];
    }
}
