<?php

namespace App\Lib;

use App\Lib\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Tartan\XmlResponse\XmlResponse;
use Tartan\XmlResponse\Exception\XmlResponseException;

/**
 * Handle api responses in xml format
 */
class ApiResponderXml extends ApiResponder
{

    /**
     * Send xml response
     * 
     * @param mixed $data
     * @param int $status Header status code
     * @return \Illuminate\Http\Response
     */
    public function response($data, $status = 200)
    {
        // Xml response does not support custom status.
        // We could extend the specific method
        
        try {
            return response()->xml($data);
        } catch (XmlResponseException $ex) {
            if (config('app.env') === 'production') {
                Log::debug($ex->getMessage());
                return response()->xml(['error' => 'An error occured. Please contact support.']);
            } else {
                return response()->xml(['error' => $ex->getMessage(), 'error_code' => $ex->getCode()]);
            }
        }
    }

}
