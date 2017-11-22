<?php

namespace App\Api\Middlewares;

use App\Api\ApiLogger;
use App\Api\Exceptions\InvalidApiVersion;
use Closure;
use App\Api\ApiVersion;

/**
 * Class ApiVersioning middleware
 *
 * @package App\Http\Middleware
 */
class ApiVersioning
{
    /**
     * Handle an incoming request and transforms the URL based on the headers api-version
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $apiVersion = ApiVersion::get($request);

        //check if the API version is in use
        if (!ApiVersion::isValid($apiVersion)) {
            throw new InvalidApiVersion(
                'Not valid api-version. Please include the api-version in the request headers. Current available versions are: '.
                implode(",",array_keys(ApiVersion::$valid_api_versions))
            );
        }

        //get the namespace of the API version
        $apiNamespace = ApiVersion::getNamespace($apiVersion);

        //log the incoming requests
        ApiLogger::info(":REQUEST: ".$request->path());

        //replace the URL /api with /api/v<$apiVersion>
        //This keeps our API RESTful
        $request->server->set('REQUEST_URI',str_replace('api/','/api/'.$apiNamespace.'/',$request->path()));

        //duplicate the request
        $dupRequest = $request->duplicate();

        return $next($dupRequest);
    }
}
