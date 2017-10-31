<?php

// Get the database connection info
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'db-connection-info.php';

// Verify that the sample data file exists
$sample_data_file = __DIR__ . DIRECTORY_SEPARATOR . 'ship_positions.csv';
$ship_data_table = 'ship_data';
$access_log_table = 'access_log';

if ( ! file_exists( $sample_data_file ) ) {
	die( sprintf( "Sample data file not found: %s", $sample_data_file ) );
}

// Open a connection to the database
$conn = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME );

if ( $conn->connect_errno ) {
	die( sprintf( "Database connection error [%d]: %s", $conn->connect_errno, $conn->connect_error ) );
}


// Set the character set
$conn->set_charset( 'utf8' );


// Create the data table if it doesn't exist

$query = sprintf( "CREATE TABLE IF NOT EXISTS `%s` (
	`mmsi` VARCHAR(20) NOT NULL,
	`status` SMALLINT unsigned,
	`speed` SMALLINT unsigned NOT NULL,
	`lon` DECIMAL(9,6) NOT NULL,
	`lat` DECIMAL(9,6) NOT NULL,
	`course` SMALLINT unsigned,
	`heading` SMALLINT unsigned,
	`rot` FLOAT,
	`timestamp` DATETIME(3) NOT NULL
)", $ship_data_table);

if ( ! $conn->query( $query ) ) {
	die( sprintf( "Failed to create table: %s", $ship_data_table ) );
}


// Create the access log table if it doesn't exist

$query = sprintf( "CREATE TABLE IF NOT EXISTS `%s` (
	`remote_ip` VARCHAR(20) NOT NULL,
	`timestamp` DATETIME(3) NOT NULL
)", $access_log_table);

if ( ! $conn->query( $query ) ) {
	die( sprintf( "Failed to create table: %s", $ship_data_table ) );
}



// Check if data table isn't empty

$query = sprintf( "SELECT COUNT(*) FROM %s", $ship_data_table );

$result = $conn->query( $query );

if ( ! $result ) {
	die( sprintf( "Failed to execute query: %s", $query ) );
}

$rows = intval( $result->fetch_array( MYSQLI_NUM )[0] );


// If data already exists, demand explicit overwrite directive to wipe it
if ( $rows ) {

	if ( ! isset( $_GET['force_overwrite'] ) || $_GET['force_overwrite'] !== 'true' ) {
		die( "Existing data was found. No action taken.\nSpecify the 'force_overwrite=true' GET parameter to wipe existing data and re-populate." );
	}

	if ( ! $conn->query( sprintf( "DELETE FROM %s", $ship_data_table ) )
	|| ! $conn->query( sprintf( "DELETE FROM %s", $access_log_table ) ) ) {
		die( sprintf( "Error wiping existing data [%d]: %s", $conn->errno, $conn->error ) );
	}

}



// Open the file and iterate through the data
$fp = fopen( $sample_data_file, 'r' );

if ( $fp === false ) {
	die( "Could not open sample data file: " . $sample_data_file );
}

$headers = fgetcsv( $fp, null, ';' );

if ( $headers === false ) {
	die( "Sample data file is empty." );
}

/*
 * Clean all the header strings from unprintable characters, since some such
 * characters were found in the original sample data file.
 */
$headers = array_map( function( $string ) {
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string );
}, $headers );

$current_row = 0;
$inserted_rows = 0;

while ( ( $row = fgetcsv( $fp, null, ';' ) ) !== false ) {

	$current_row++;

	// Skip the row if number of fields is incorrect
	if ( count( $row ) != count( $headers ) ) {

		printf( "Insertion failed for row %d: expecting %d fields, but %d were found\n", $current_row, count( $headers ), count( $row ) );

		$failed_rows[] = $current_row;

		continue;

	}

	// Attach the headers for convenience
	$row = array_combine( $headers, $row );

	// Replace any decimal points that might differe based on locale
	$row['LON'] = replace_decimal_points( $row['LON'] );
	$row['LAT'] = replace_decimal_points( $row['LAT'] );

	$query = sprintf( "INSERT INTO %s VALUES (
		'{$row['MMSI']}',
		{$row['STATUS']},
		{$row['SPEED']},
		{$row['LON']},
		{$row['LAT']},
		{$row['COURSE']},
		{$row['HEADING']},
		{$row['ROT']},
		'{$row['TIMESTAMP']}'
	)", $ship_data_table );

	if ( ( $result = $conn->query( $query ) ) !== false ) {

		$inserted_rows++;

	} else {

		printf( "Insertion failed for row %d [%d]: %s\n", $current_row, $result->errno, $result->error );

		$failed_rows[] = $current_row;

	}

}

printf( "\nTotal rows processed: %d\nTotal rows inserted: %d", $current_row, $inserted_rows );

// Close the data file
fclose( $fp );

// Close the connection to the database
$conn->close();

function replace_decimal_points( $string ) {
	return str_replace( ',', '.', $string);
}