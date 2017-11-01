<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vessel;

/**
 * Sample RESTful controller for Vessels
 * 
 * This is just to demostrate the concept of resource controllers in REST.
 * Anyone with a valid api_token can do CRUD operations in vessels table.
 */
class VesselController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //sample code to display vessels in json
        return response()->json(Vessel::paginate(config('app.ff_api_per_page')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //not used in api
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //sample code
        $vessel = Vessel::create($request->only(['name', 'mmsi']));
        
        return response()->json($vessel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //sample code
        $vessel = Vessel::findOrFail($id);
        
        return response()->json($vessel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //not used in api
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //sample code
        $vessel = Vessel::findOrFail($id);
        $vessel->update($request->only(['name', 'mmsi']));
        
        return response()->json($vessel);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //sample code
        $vessel = Vessel::findOrFail($id);
        $vessel->delete();
        
        return response()->json(null, 204);
    }

}
