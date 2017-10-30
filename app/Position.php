<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mmsi', 'status', 'station', 'speed', 'longtitude', 'latitude', 'course', 'heading', 'rot', 'timestamp'
    ];

    /**
     * Boot
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->timestamp = $model->freshTimestamp();
        });
    }
}
