<?php

namespace App\Lib;

use App\Lib\ApiResponder;


/**
 * Handle api responses in json format
 */
class ApiResponderJson extends ApiResponder
{

    /**
     * Send json response
     * 
     * @param mixed $data
     * @param int $status Header status code
     * @return \Illuminate\Http\Response
     */
    public function response($data, $status = 200) {
        return response()->json($data, $status);
    }
}
