<?php

namespace App\Api;

/**
 * Class ApiVersion
 *
 * This class defines the available Api Versions along with the relevant namespaces.
 * In order to keep our API RESTful the URL's must be kept the same among API versions.
 * Thus, the ApiVersion middleware will be responsible to translate the path into the respective namespace
 *
 * @package App\Api
 */
class ApiVersion {

    /**
     * The valid API versions
     *
     * @var array
     */
    public static $valid_api_versions = [
        1 => 'v1'
    ];

    /**
     * The API modules for each version.In case we want to enable or disable a module,
     * we should change the array accordingly
     *
     * @var array
     */
    public static $valid_api_modules = [
        "v1" =>
            [
                "vesselTrack"
            ]
    ];

    /**
     * Our API is only available for read requests (GET). So, any other methods should be rejected.
     * The middleware ApiRequestHeaders will be responsible to validate or not the request.
     *
     * @var array
     */
    public static $valid_http_methods = [
        "v1" => ['GET']
    ];

    /**
     * Returns the available projects of each API version
     *
     * @param integer $version
     * @return mixed|null
     */
    public static function getApiModules($version)
    {
        if($namespace = self::getNamespace($version)){
            return self::$valid_api_modules[$namespace];
        }

        return null;
    }

    /**
     * Returns the acceptable HTTP methods
     *
     * @param $version
     * @return array
     */
    public static function getHttpMethods($version)
    {
        if($namespace = self::getNamespace($version)){
            return self::$valid_http_methods[$namespace];
        }

        return null;
    }

    /**
     * Resolve the requested api version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return integer
     */
    public static function get($request) {
        return intval($request->header('api-version'));
    }

    /**
     * Determines if a version is valid or not
     *
     * @param integer $apiVersion
     * @return bool
     */
    public static function isValid($apiVersion) {
        return in_array(
            $apiVersion,
            array_keys(self::$valid_api_versions)
        );
    }

    /**
     * Resolve namespace for a api version
     *
     * @param integer $apiVersion
     * @return string
     */
    public static function getNamespace($apiVersion)
    {
        if (!self::isValid($apiVersion)) {
            return null;
        }

        return self::$valid_api_versions[$apiVersion];
    }

}