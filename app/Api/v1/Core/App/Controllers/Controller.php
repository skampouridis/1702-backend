<?php

namespace App\Api\v1\Core\App\Controllers;

use App\Api\ApiDataParser;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class Controller
 *
 * Our API controller which will be extended by rest API controllers
 *
 * @package App\Api\v1\Core\App\Controllers
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * These function will be executed from the controller methods in order to return the output data in a specified format.
     *
     * @param Request $request
     * @param $data
     * @return array
     */
    public function toOutputFormat(Request $request, $data)
    {
        $format= $request->get('output-format','json');
        $parser = ApiDataParser::make($data,$format);
        $output = $parser->parse();

        switch($format) {
            case 'json':
                $response = $this->toJson($output);
                break;
            case 'csv':
                $response = $this->toCsv($output);
                break;
            case 'xml':
                $response = $this->toXml($output);
                break;
            default: $response = $this->toJson($output);
        }

        return $response;
    }

    /**
     * Return the XML data
     *
     * @param $data
     * @return mixed
     */
    public function toXml($data)
    {
        return response($data)
            ->header('Content-Type', "text/xml");
    }

    /**
     * Returns the CSV data
     *
     * @param $data
     * @return mixed
     */
    public function toCsv($data)
    {
        return response($data)
            ->header('Content-Type', "text/csv");
    }

    /**
     * Returns the json response
     *
     * @param $data
     * @return array
     */
    public function toJson($data)
    {
        return [
            "code"=>$this->responseCode,
            "status"=>$this->responseStatus,
            "message"=>$this->responseMessage,
            "total"=>sizeof($data),
            "data"=>$data
        ];
    }
}
