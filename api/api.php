<?php

// Include the dependencies
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class-database-controller.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'class-mt-rest-api-controller.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'db-connection-info.php';

// Instantiate the API
$api = new MT_REST_API_Controller( DB_HOST, DB_NAME, DB_USER, DB_PASS );

/*
 * Uncomment the following line to print debug messages
 */
// $api->set_debug( true );

// Let the API server the request
$api->serve_request();