<?php

namespace App\Http\Controllers;

use App\Vessel;
use App\http\Resources\Vessel as VesselResource;
use App\Http\Resources\VesselCollection;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new VesselCollection(Vessel::get());
    }

    /**
     * Display the specified resource.
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vessel = Vessel::with(['tracks', 'searches'])->findOrFail($id);

        return new VesselResource($vessel);
    }

}
