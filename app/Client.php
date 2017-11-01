<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public $timestamps = false;
    public $fillable = ['ip'];

    public function searches()
    {
        return $this->hasMany('App\Search');
    }

}
