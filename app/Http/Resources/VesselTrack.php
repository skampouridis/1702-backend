<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VesselTrack extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {

        $this->vessel;
        unset($this->vessel_id);

        return parent::toArray($request);
    }
}
