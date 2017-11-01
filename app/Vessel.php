<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vessel extends Model
{

    public $fillable = ['mmsi'];
    public $timestamps = false;

    public function searches() {
        return $this->belongsToMany('App\Search');
    }

    public function tracks() {
        return $this->hasMany('App\VesselTrack');
    }

}
