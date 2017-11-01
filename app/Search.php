<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

    public $timestamps = false;
    public $fillable = ['client_id', 'lat_from', 'lat_to', 'lon_from', 'lon_to'];

    public function vessels() {
        return $this->belongsToMany('App\Vessel');
    }

    public function tracks() {
        return $this->belongsToMany('App\VesselTrack');
    }

}
