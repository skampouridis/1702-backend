<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Resources\Client as ClientResource;
use App\Http\Resources\ClientCollection;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ClientCollection(Client::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Client::where('id', $id)->exists()) {
            $client = Client::with('searches')->find($id);

            return new ClientResource($client);
        }
        return response()->json(['error' => 'Not Found.'])->setStatusCode(404);
    }

}
