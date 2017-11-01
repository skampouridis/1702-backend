<?php

namespace App\Http\Controllers;

use App\VesselTrack;
use App\Http\Resources\VesselTrack as VesselTrackResource;
use App\Http\Resources\VesselTrackCollection;

class VesselTrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VesselTrackCollection(VesselTrack::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $track = VesselTrack::with('vessel')->findOrFail($id);

        return new VesselTrackResource($track);
    }

}
