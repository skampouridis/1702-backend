<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'requests';

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
        'method', 'url', 'full_request', 'timestamp'
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
