<?php

namespace App\Lib;

use App\Lib\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Neoxia\Routing\ResponseFactory;

/**
 * Handle api responses in csv format
 */
class ApiResponderCsv extends ApiResponder
{

    /**
     * Send csv response
     * 
     * @param mixed $data
     * @param int $status Header status code
     * @return \Illuminate\Http\Response
     */
    public function response($data, $status = 200) {
        $options = [
            'encoding' => 'UTF8',
            'delimiter' => ',',
            'quoted' => true,
            'include_header' => true,
        ];        
        
        // error - transform so it works with Neoxia
        if (array_key_exists('error', $data) AND count($data) === 1) {            
            $data_err = [
                0 => ['error' => $data['error'], 'error_code' => $status]
            ];
            $data = $data_err;            
        }
        
        return response()->csv($data, $status, [], $options);
    }
}
