<?php

class MT_REST_API_Controller {

	/**
	 * The response headers are stored here.
	 * @var array
	 */
	protected $response_headers;

	/**
	 * The database controller instance.
	 * @var Database_Controller
	 */
	protected $database;

	/**
	 * The parameters of the request.
	 * @var array
	 */
	protected $request_params;

	/**
	 * The maximum number of requests that the API will accept per hour,
	 * from a given client IP.
	 * @var integer
	 */
	protected $request_limit_per_hour = 100;

	/**
	 * Holds the retrieve data, prior to sending it as part of the response.
	 * @var array
	 */
	protected $data;

	/**
	 * Debug mode flag for convenience.
	 * @var bool
	 */
	protected $debug;

	/**
	 * Class constructor. Instantiates the class, but does not take any further
	 * action.
	 * 
	 * @param string $db_host The database server's hostname
	 * @param string $db_name The database's name
	 * @param string $db_user The user to use for database connections
	 * @param string $db_pass The user's password
	 */
	public function __construct( $db_host, $db_name, $db_user, $db_pass ) {

		// Initialize class properties
		$this->response_headers = array();

		$this->database = new Database_Controller( $db_host, $db_name, $db_user, $db_pass );

		$this->request_params = $_GET;

		$this->data = array();

		$this->debug = false;

	}

	/**
	 * Handles the main workflow during a request.
	 * @return void
	 */
	public function serve_request() {

		// Check request method
		if ( $_SERVER['REQUEST_METHOD'] !== 'GET' ) {

			$this->send_response( 405, 'Invalid method: ' . $_SERVER['REQUEST_METHOD'] );
			die;

		}

		// Check hourly request limit
		if ( $this->request_limit_reached() ) {

			$this->send_response( 429, 'Too many requests' );
			die;

		}

		if ( $this->debug ) {

			printf( "Raw GET parameters:\n" );
			var_dump( $this->request_params );

		}

		// Validate and sanitize parameters
		if ( ! $this->validate_sanitize_params() ) {

			$this->send_response( 400, 'Invalid parameters' );
			die;
		}

		if ( $this->debug ) {

			printf( "Sanitized GET parameters:\n" );
			var_dump( $this->request_params );

		}

		// Get the data
		$this->data = $this->get_data();

		// And send 'em!
		$this->send_data();

		// Log the request
		$this->log_request();

		// Cleanup
		$this->cleanup();

	}

	/**
	 * Sets the appropriate headers and sends the retrieved data, after properly
	 * formatting it.
	 * @return void
	 */
	protected function send_data() {

		// No data is a status 404
		if ( empty( $this->data ) ) {

			$this->send_response( 404, 'No matching data found' );
			return;

		}

		// Determine the format, using JSON as default
		$format = ! empty( $this->request_params['format'] ) ? $this->request_params['format'] : 'json';

		$data = $this->get_formatted_data( $format );

		// Ensure a response is always sent, even in unexpected cases
		if ( $data === false ) {

			$this->internal_error();

		}

		// Set the appropriate headers
		switch ( $format ) {

			case 'json' :

				$this->set_header( 'Content-Type:application/json');
				break;

			case 'xml' :

				$this->set_header( 'Content-Type:application/xml');
				break;

			case 'csv' :

				$this->set_header( 'Content-Type:text/csv');
				break;

		}

		// Send a status 200
		$this->send_response( 200, 'OK', $data );

	}

	/**
	 * Formats the retrieved data according to a given format (JSON, XML or CSV).
	 *
	 * @param  string $format The format to use. Either 'json', 'xml', or
	 *                        'csv'. The expected values are lower-case
	 *                        and case-sensitive.
	 * @return string|bool    The formatted data on success, or false otherwise.
	 */
	protected function get_formatted_data( $format ) {

		switch ( $format ) {

			case 'json' :

				return json_encode( $this->data );

			case 'xml' :

				// Implement a simple array-to-XML funcationality
				$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";

				$xml .= "\n<positions>";

				foreach ( $this->data as $record ) {

					$xml .= "\n\t<record>";

					foreach ( $record as $field => $val ) {
						$xml .= "\n\t\t<$field>$val</$field>";
					}

					$xml .= "\n\t</record>";

				}

				$xml .= "\n</positions>";

				return $xml;				

			case 'csv' :

				// Use the temp stream to facilitate output to CSV format, utilizing PHP's fputcsv
				$fp = fopen( 'php://temp', 'r+' );

				// Dump all the lines to the stream
				foreach ( $this->data as $row ) {
					fputcsv( $fp, $row );
				}

				// Rewind the handle, re-read the stream's contents into string, and return it
				rewind( $fp );

				ob_start();
				
				fpassthru($fp);

				$csv = ob_get_clean();

				fclose( $fp );

				return $csv;

			default :

				return false;

		}

	}

	/**
	 * Validates and sanitizes the parameters passed with the request.
	 * 
	 * Note that, if validation succeeds, the data is stored on the respective
	 * class property (and not returned).
	 * 
	 * @return bool True if all parameters were valid, false other wise.
	 */
	protected function validate_sanitize_params() {

		$valid_params = array( 'mmsi', 'longtitude_min', 'longtitude_max', 'latitude_min', 'latitude_max', 'date_from', 'date_to', 'format' );

		$params = $this->request_params;

		// Ensure that all of the passed parameter names are valid
		if ( ! empty( array_diff( array_keys( $params ), $valid_params ) ) ) {
			return false;
		}

		// Validate MMSI
		if ( ! empty( $params['mmsi'] ) ) {

			// Convert MMSI to array
			if ( is_string( $params['mmsi'] ) ) {
				$params['mmsi'] = array( $params['mmsi'] );
			}

			// Ensure MMSIs are alphanumeric
			foreach ( $params['mmsi'] as $mmsi ) {

				if ( ! ctype_alnum( $mmsi ) ) {
					return false;
				}

			}

		}		

		// Validate coordinates
		foreach ( array( 'longtitude_min', 'longtitude_max', 'latitude_min', 'latitude_max' ) as $param_name ) {

			// Skip undefined parameters
			if ( ! isset( $params[ $param_name ] ) ) {
				continue;
			}

			// Ensure a numeric value is represented
			if ( ! is_numeric( $params[ $param_name ] ) ) {
				return false;
			}

			// Convert to floats
			$params[ $param_name ] = floatval( $params[ $param_name ] );

			// Ensure the numeric value is within bounds
			if ( in_array( $param_name, array( 'longtitude_min', 'longtitude_max' ) )
				&& ( $params[ $param_name ] < -180 || $params[ $param_name ] > 180 ) ) {

				return false;

			}

			if ( in_array( $param_name, array( 'latitude_min', 'latitude_max' ) )
				&& ( $params[ $param_name ] < -90 || $params[ $param_name ] > 90 ) ) {

				return false;

			}

		}

		// Validate dates
		foreach ( array( 'date_from', 'date_to' ) as $param_name ) {
			
			if ( ! isset( $params[ $param_name ] ) ) {
				continue;
			}
		
			// Ensure string represents a timestamp, and convert to int
			if ( $this->string_is_timestamp( $params[ $param_name ] ) ) {

				$params[ $param_name ] = intval( $params[ $param_name ] );

			} else {

				return false;

			}

		}


		// Validate format
		if ( isset( $params['format'] ) && ! in_array( $params['format'], array( 'json', 'xml', 'csv' ) ) ) {
			return false;
		}

		$this->request_params = $params;

		return true;

	}

	/**
	 * Sends an HTTP response, given a status code, a message, and (optionally)
	 * some data to send.
	 *
	 * This method is responsible for sending all the response headers that
	 * have been set, prior to sening the actual data payload.
	 * 
	 * @param  int    $status_code The HTTP status code to send
	 * @param  string $message     The HTTP Reason-Phrase to use in the
	 *                             response
	 * @param  string $data        The data payload
	 * @return void
	 */
	protected function send_response( $status_code, $message, $data = null ) {

		$protocol = isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

		$this->set_header( "$protocol $status_code $message" );

		$this->send_headers();

		echo $data;

	}

	/**
	 * Convenience method for handling internal errors. Sends the appropriate
	 * response, handles cleanup, and terminates script execution.
	 * 
	 * @return void
	 */
	protected function internal_error() {

		$this->send_response( 500, 'Internal error' );
		$this->cleanup();
		die;

	}

	/**
	 * Sets a response header, that will be sent with the response.
	 * 
	 * @param  string The header's value
	 * @return void
	 */
	protected function set_header( $header ) {

		$this->response_headers[] = $header;

	}

	/**
	 * Sends all response headers that have been set up to the time the method
	 * is called.
	 *
	 * Ensures that the headers are sent only once.
	 * 
	 * @return bool True if the headers were sent, or false if they have
	 *              already been sent.
	 */
	protected function send_headers() {

		static $headers_sent;

		if ( null === $headers_sent ) {

			foreach ($this->response_headers as $header ) {
				header( $header );
			}

			$headers_sent = true;

			return true;
			
		}

		return false;

	}

	/**
	 * Retrieves the data from the database, based on the request parameters.
	 * 
	 * @return array The retrieved data, in the form of an associative array.
	 */
	protected function get_data() {

		$params = $this->request_params;

		// Initialize the query parts
		$query = array(
			'select' => '*',
			'from'   => 'ship_data',
			'where'  => array('1'),
		);

		// Add the appropriate WHERE conditions for filtering
		if ( ! empty( $params['mmsi'] ) ) {

			// Wrap quotation marks around MMSIs and escape string input
			foreach ( $params['mmsi'] as $key => $val ) {
				$params['mmsi'][ $key ] = "'" . $this->database->escape_string( $val ) . "'";
			}

			$query['where'][] = 'mmsi IN (' . implode( ', ', $params['mmsi'] ) . ')';

		}
		
		if ( $params['latitude_min'] ) {
			$query['where'][] = "lat >= {$params['latitude_min']}";
		}

		if ( $params['latitude_max'] ) {
			$query['where'][] = "lat <= {$params['latitude_max']}";
		}

		if ( $params['longtitude_min'] ) {
			$query['where'][] = "lon >= {$params['longtitude_min']}";
		}

		if ( $params['longtitude_max'] ) {
			$query['where'][] = "lon <= {$params['longtitude_max']}";
		}

		if ( $params['date_from'] ) {
			$query['where'][] = "timestamp >= {$params['date_from']}";
		}

		if ( $params['date_to'] ) {
			$query['where'][] = "timestamp <= {$params['date_to']}";
		}

		// Build the various query parts
		$select = $query['select'];
		$from = $query['from'];

		// Wrap parentheses around WHERE conditions
		foreach ( $query['where'] as $key => $val ) {
			$query['where'][ $key ] = "($val)";
		}

		$where = implode( ' AND ', $query['where'] );

		// Build the query string and execute
		$result = $this->query( "SELECT $select FROM $from WHERE $where");

		if ( $result === false ) {
			$this->internal_error();
		}

		// Gather the results onto an array. Not using mysqli::fetch_all() for compatibility purposes
		$data = array();

		while( $row = $result->fetch_assoc() ) {
			$data[] = $row;
		}

		return $data;

	}

	/**
	 * Checks if the originator IP of the current request has reached the
	 * hourly limit.
	 * 
	 * @return bool True if the limit has been reached, or false otherwise.
	 */
	protected function request_limit_reached() {

		$remote_ip = $_SERVER['REMOTE_ADDR'];
		$last_hour = $this->timestamp2datetime( strtotime( '1 hour ago' ) );

		$result = $this->query( sprintf( "SELECT COUNT(*)
			FROM access_log
			WHERE remote_ip = '%s'
				AND timestamp >= '%s'", $remote_ip, $last_hour ) );

		return intval( $result->fetch_array( MYSQLI_NUM )[0] ) >= $this->request_limit_per_hour;

	}

	/**
	 * Logs the current request to the database (remote IP and timestamp).
	 * 
	 * @return bool True on success, false on failure.
	 */
	protected function log_request() {

		$remote_ip = $_SERVER['REMOTE_ADDR'];
		$timestamp = $this->timestamp2datetime( time() );

		$result = $this->query( "INSERT INTO access_log VALUES ( '$remote_ip', '$timestamp' )" );

		return ( false === $result ) ? false : true;

	}

	/**
	 * Convenience method that converts a UNIX timestamp to the format expected
	 * by MySQL for DATETIME fields.
	 * 
	 * @param  int    $timestamp The UNIX timestamp
	 * @return string            The timestamp formatted as 'Y-m-d H:i:s'.
	 */
	protected function timestamp2datetime( $timestamp ) {
		return date( 'Y-m-d H:i:s', $timestamp );
	}

	/**
	 * Checks if a string represents a valid UNIX timestamp.
	 * 
	 * @param  string $string The string to check.
	 * @return bool           True if the string represents a timestamp, or
	 *                        false otherwise.
	 */
	protected function string_is_timestamp( $string ) {

		// Attempt to convert to DateTime
		try {

			$dt = new DateTime( "@$string" );

		} catch ( Exception $e ) {

			return false;

		}

		// If succeeded, verify correct timestamp value
		return $string === (string) $dt->getTimestamp();

	}

	/**
	 * Wrapper function that handles SQL query execution throughout the class.
	 * 
	 * @param  string $query      The query to execute.
	 * @return mysqli_result|bool A mysqli_result object on success, or false
	 *                            on failure.
	 */
	protected function query( $query ) {

		return $this->database->query( $query );

	}

	/**
	 * Cleans up the environment. Closes any open database connections, files
	 * etc.
	 * 
	 * @return void
	 */
	protected function cleanup() {

		if ( null !== $this->database ) {

			$this->database->disconnect();

		}

	}

	/**
	 * Sets debug mode for this class on or off.
	 *
	 * Turning debug mode on will result in various debug-assisting messages
	 * and variables to be dumped on the output.
	 * 
	 * @param  bool $debug True to set debug mode on, or false to turn it off.
	 * @return void
	 */
	public function set_debug( $debug ) {

		if ( is_bool( $debug ) ) {

			$this->debug = $debug;

			if ( $this->database ) {

				$this->database->set_debug( $debug );

			}

		}

	}

}