<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Position;

/**
 * Vessel position controller (only search method - for sample RESTful CRUD see VesselController)
 */
class PositionController extends Controller
{

    /**
     * Request
     * 
     * @var  \Illuminate\Http\Request  $request
     */
    protected $request;

    /**
     * Constructor
     *
     * @param  \Illuminate\Http\Request  $request     
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        \App\Lib\ApiResponder::detectFormat($request);
    }

    /**
     * Search vessel positions
     *     
     * @return \App\Lib\ApiResponder that returns json|xml|csv|whatever of \Illuminate\Http\Response
     */
    public function search()
    {
        $filters = Position::getSearchFilters($this->request->all());
        $data = Position::getSearchResult($filters);

        return \App\Lib\ApiResponder::doResponse($data);
    }

}
