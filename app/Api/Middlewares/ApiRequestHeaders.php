<?php

namespace App\Api\Middlewares;

use App\Api\Exceptions\InvalidRequestMethod;
use Closure;
use App\Api\ApiVersion;

/**
 * Class ApiRequestHeaders middleware
 *
 * @package App\Http\Middleware
 */
class ApiRequestHeaders
{
    /**
     * Handle an incoming request and validates the requests method
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $apiVersion = ApiVersion::get($request);
        $methods = ApiVersion::getHttpMethods($apiVersion);

        //check if the HTTP method is permitted in the API
        if (!in_array($request->getMethod(), $methods)) {
            throw new InvalidRequestMethod('The HTTP request method '.$request->getMethod().' is not allowed.');
        }

        return $next($request);
    }
}
