<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Sample vessel model (not functional - just for demostration)
 */
class Vessel extends Model
{

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Blacklist fields for mass assignment
     *
     * @var array
     */
    protected $guarded = [];

}
