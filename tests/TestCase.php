<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    
    /**
     * Get test api token url param
     * 
     * @return string
     */
    public static function getApiToken()
    {        
        return 'api_token=UTUQNqMQkKyHUU4HXntrlCxrNfyB6rduuMLC0DCAKbIXbnZqihXFTmxGt3D7NLmD';
    }
}
