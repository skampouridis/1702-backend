<?php

class Database_Controller {

	/**
	 * The database server's hostname
	 * @var string
	 */
	protected $db_host = null;

	/**
	 * The database's name
	 * @var string
	 */
	protected $db_name = null;

	/**
	 * The username to use for database connections
	 * @var string
	 */
	protected $db_user = null;

	/**
	 * The password to use for database connections
	 * @var string
	 */
	protected $db_pass = null;

	/**
	 * The MySQL server connection object
	 * @var mysqli
	 */
	protected $db_connection = null;

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

		$this->debug = false;

		$this->response_headers = array();

		$this->db_host = $db_host;
		$this->db_name = $db_name;
		$this->db_user = $db_user;
		$this->db_pass = $db_pass;

	}

	/**
	 * Executes an unprepared query.
	 *
	 * Initiates a database connection, if not already connected.
	 * 
	 * @param  string $query      The query to execute
	 * @return mysqli_result|bool A mysqli_result object on successful query
	 *                            execution, or false on any error (connection
	 *                            or query execution).
	 */
	public function query( $query ) {

		if ( ! $this->connect() ) {

			return false;
			
		}

		if ( $this->debug ) {

			printf( "Executing query:\n" );
			var_dump( $query );

		}

		$result = $this->db_connection->query( $query );

		if ( $this->debug ) {

			printf( "Got result:\n" );
			var_dump( $result );

		}

		return $result;

	}

	/**
	 * Initiates a database connection, if not already connected.
	 * 
	 * @return bool True on success, false on failure
	 */
	public function connect() {

		if ( $this->db_connection === null ) {

			$conn = new mysqli( $this->db_host, $this->db_user, $this->db_pass, $this->db_name );

			if ( $conn->connect_errno ) {

				return false;

			} else {

				$this->db_connection = $conn;

				return true;
			}

		}

		return true;

	}

	/**
	 * Terminates the database connection, if one was initiated.
	 * 
	 * @return void
	 */
	public function disconnect() {

		if ( $this->db_connection !== null ) {

			$this->db_connection->close();

		}

	}

	/**
	 * Escapes string input for queries.
	 * 
	 * @param  string $str The string to escape
	 * @return string      The escaped string
	 */
	public function escape_string( $str ) {

		if ( ! $this->connect() ) {

			return '';
			
		}

		return $this->db_connection->real_escape_string( $str );

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
			
		}

	}

}