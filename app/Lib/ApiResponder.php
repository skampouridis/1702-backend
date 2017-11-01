<?php

namespace App\Lib;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Handle api responses in various formats
 *
 */
abstract class ApiResponder
{

    /**
     * Default format
     */
    const FORMAT_DEFAULT = 'json';

    /**
     * Detected format
     * 
     * @var string
     */
    protected static $format = null;

    /**
     * Send response
     * @param mixed $data
     * @param int $status Header status code
     * @return \Illuminate\Http\Response
     */
    abstract public function response($data, $status = 200);

    /**
     * Detect output format - if none or invalid then default to json
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public static function detectFormat(Request $request)
    {
        $_format = static::FORMAT_DEFAULT;
        if ($request->has('format')) {
            $_format = strtolower($request->format);
            $class = '\App\Lib\ApiResponder' . ucfirst($_format);
            if (!class_exists($class)) {
                $_format = static::FORMAT_DEFAULT;
            }
        }

        static::$format = $_format;
    }

    
    /**
     * Get output format
     *      
     * @return string
     */
    public static function getFormat()
    {
        return static::$format;
    }
    
    /**
     * Send the response via subclasses
     * 
     * @param \Illuminate\Http\Request  $request
     * @param int $status Header status code
     * @see \Illuminate\Http\Response
     * @return ApiResponder
     */
    public static function doResponse($data, $status = 200)
    {
        // in case doResponsed called without detectFormat
        if (static::$format === null) {
            static::$format = static::FORMAT_DEFAULT;
        }
        // create subclass
        $class = '\App\Lib\ApiResponder' . ucfirst(static::$format);
        $instance = new $class;
        return $instance->response($data, $status);
    }

}
