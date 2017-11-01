<?php

/*
 * The MIT License
 *
 * Copyright 2016. Antonis Adamakos <antonis at fuzzfree.com>.
 */

/**
 * FuzzFree main helper class
 * 
 * A collection of useful static methods
 */
abstract class FF
{

    /**
     *  Request a var (GET, POST, REQUEST, COOKIE)
     * 
     *  @param string $hash
     *  @param mixed $var
     *  @param mixed $default
     *  @return mixed cleaned 
     */
    public static function request($hash, $var, $default = null)
    {
        if (isset($hash[$var])) {
            return self::varCleanFromInput($hash[$var]);
        }
        return $default;
    }

    /** 	 
     *  Clean a variable - generic
     *  @param mixed $var string or array
     *  @return mixed cleaned
     */
    public static function varCleanFromInput($var)
    {
        if (empty($var)) {
            /* enpty like 0 or null or '' or [] or stdClass */
            return $var;
        }

        if (is_array($var)) {
            foreach ($var as $key => $val) {
                $var[$key] = self::varCleanFromInput($val);
            }
            return $var;
        }
        if (is_object($var)) {
            foreach (get_object_vars($var) as $key => $val) {
                $var->$key = self::varCleanFromInput($val);
            }
            return $var;
        }

        $var = strip_tags($var);
        $var = html_entity_decode($var);
        $var = filter_var($var, FILTER_UNSAFE_RAW, FILTER_FLAG_STRIP_LOW);
        $var = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $var);
        $var = trim($var, "\xc2\xa0");
        $var = trim($var);

        //replace double quotes with single quotes
        //$var = str_replace('"', '\'', $var);

        return $var;
    }

    /** 	 
     *  Clean a variable but keep lines
     * 
     *  @see varCleanFromInput
     *  @param string $var
     *  @return string cleaned
     */
    public static function varCleanFromInputKeepLines($var)
    {
        $var = preg_replace('~\R~u', '__FFNL__', $var);
        $var = self::varCleanFromInput($var);
        $var = str_replace('__FFNL__', "\n", $var);
        $var = trim($var, "\xc2\xa0");
        $var = trim($var);

        return $var;
    }

    /** 	 
     *  Prepare a variable for output
     *  @param mixed $var string or array
     *  @return mixed cleaned ready for display	 
     */
    public static function varPrepForDisplay($var)
    {
        if (is_array($var)) {
            foreach ($var as $key => $val) {
                $var[$key] = self::varPrepForDisplay($val);
            }
            return $var;
        }
        $var = trim($var);
        $var = htmlspecialchars($var, ENT_COMPAT, 'UTF-8');
        return $var;
    }

    /** 	 
     *  Alias for varPrepForDisplay
     *  @param mixed $var string or array
     *  @see FF::varPrepForDisplay	 
     */
    public static function e($var)
    {
        return self::varPrepForDisplay($var);
    }

    
    /** 	 
     *  Validate date timestamp
     *  @param string $var
     *  @return boolean
     */
    public static function validateDatetime($var, $format = 'Y-m-d H:i:s')
    {
        try {
            \DateTime::createFromFormat($format, $var);
        } catch (\Exception $ex) {
            return false;
        }
        return true;
    }
    
    /** 	 
     *  DB escape - quick shortcut for laravel
     * 
     *  @param mixed $var
     *  @param string $con connection (see config/database)
     *  @return \PDO::quote()
     */
    public static function q($var, $con = 'mysql')
    {        
        return \DB::connection($con)->getPdo()->quote($var);
    }
    
    /**
     *  Get real ip address even if server or client is behind proxies/lb etc.
     *  Borrowed from Oscommerce	 
     *  @return string Found ip v4 address
     */
    public static function getRealIpAddress()
    {
        static $_ip_address;
        if (!isset($_ip_address)) {
            $_ip_address = '0.0.0.0';
            $ip_addresses = array();
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                foreach (array_reverse(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])) as $x_ip) {
                    $x_ip = trim($x_ip);
                    if (filter_var($x_ip, FILTER_VALIDATE_IP, array('flags' => FILTER_FLAG_IPV4))) {
                        $ip_addresses[] = $x_ip;
                    }
                }
            }
            if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_addresses[] = $_SERVER['HTTP_CLIENT_IP'];
            }
            if (isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && !empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
                $ip_addresses[] = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
            }
            if (isset($_SERVER['HTTP_PROXY_USER']) && !empty($_SERVER['HTTP_PROXY_USER'])) {
                $ip_addresses[] = $_SERVER['HTTP_PROXY_USER'];
            }
            if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR'])) {
                $ip_addresses[] = $_SERVER['REMOTE_ADDR'];
            }
            foreach ($ip_addresses as $ip) {
                if (!empty($ip) AND filter_var($ip, FILTER_VALIDATE_IP, array('flags' => FILTER_FLAG_IPV4))) {
                    $_ip_address = $ip;
                    break;
                }
            }
        }
        return $_ip_address;
    }

    /**
     *   Dump data
     * 
     *   @param string 	 
     *   @param boolean
     * 	 @return string	  
     */
    public static function dd($var, $exit = true)
    {
        echo "<pre>";
        print_r($var);
        echo "</pre>";
        if ($exit) {
            exit(1);
        }
    }

}
