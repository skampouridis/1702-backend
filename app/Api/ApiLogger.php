<?php

namespace App\Api;

use Log;

/**
 * Class ApiLogger
 *
 * It uses the Log facade of laravel framework to store the logs in the storage/logs/laravel.log file.
 *
 * @package App\Api
 */
class ApiLogger
{
    /**
     * Saves an info message
     *
     * @param $message
     */
    public static function info($message)
    {
        Log::info($message);
    }

    /**
     * Saves an emergency message
     *
     * @param $message
     */
    public static function emergency($message)
    {
        Log::emergency($message);
    }

    /**
     * Saves an alert message
     *
     * @param $message
     */
    public static function alert($message)
    {
        Log::alert($message);
    }

    /**
     * Saves a critical message
     *
     * @param $message
     */
    public static function critical($message)
    {
        Log::critical($message);
    }

    /**
     * Saves an error message
     *
     * @param $message
     */
    public static function error($message)
    {
        Log::error($message);
    }

    /**
     * Saves a warning message
     *
     * @param $message
     */
    public static function warning($message)
    {
        Log::warning($message);
    }

    /**
     * Saves a notice message
     *
     * @param $message
     */
    public static function notice($message)
    {
        Log::notice($message);
    }

    /**
     * Saves a debug message
     *
     * @param $message
     */
    public static function debug($message)
    {
        Log::debug($message);
    }

}