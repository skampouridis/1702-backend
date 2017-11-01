<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

/**
 *  Index controller
 */
class IndexController extends Controller
{

    /**
     * Show readme information about API task
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

}
