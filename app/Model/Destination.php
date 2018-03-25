<?php

class Destination extends AppModel {

	public function getData ( $parameters ) {
		if( !empty($parameters) ) {

			$options = array();

			//if mmsi is defined
			if( isset($parameters['mmsi'] ) ) {

				//check if we have multiple ids and create array of mmsi
				if( strpos($parameters['mmsi'], ",") ) {
					$parameters['mmsi'] = explode(',', $parameters['mmsi']);
					if ( !$this->validNumbers($parameters['mmsi']) ) {
						return array(
							'success' => false,
							'msg' => 'All MMSI should be numeric values'
						);
					}else{
						$options['mmsi'] = $parameters['mmsi'];
					}
				}else{
					//check if mmsi is a number
					if( !is_numeric($parameters['mmsi']) ) {
						return array(
							'success' => false,
							'msg' => 'MMSI should be numeric value'
						);
					}else{
						$options['mmsi'] = $parameters['mmsi'];
					}
				}
			}

			//if both lon and lat are defined
			if( isset( $parameters['lon'] ) && isset( $parameters['lat'] ) )  {
				if( $this->validNumbers( array($parameters['lon'], $parameters['lat']) ) ) {
					if( isset($parameters['radius']) ) {
						//user defined radius in km
						if( is_numeric($parameters['radius']) ){
							$rad = $parameters['radius'];
						} else {
							return array(
								'success' => false,
								'msg' => 'Radius should be numeric.'
							);
						}
					} else {
						//default radius in km
						$rad = 0.5;
					}

					$R = 6371;  // earth's mean radius, km

					$lat = $parameters['lat'];
					$lon = $parameters['lon'];

					$maxLat = $lat + rad2deg($rad/$R);
					$minLat = $lat - rad2deg($rad/$R);
					$maxLon = $lon + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
					$minLon = $lon - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));

					$options['lat BETWEEN ? AND ?'] = array( $minLat, $maxLat );
					$options['lon BETWEEN ? AND ?'] = array( $minLon, $maxLon );
				} else {
					return array(
						'success' => false,
						'msg' => 'Lon, Lat should be numeric.'
					);
				}
				
			} else if ( isset( $parameters['lon'] ) xor isset( $parameters['lat'] ) ) {
				return array(
					'success' => false,
					'msg' => 'Please define both lat & lon. Optionaly define radius.'
				);
			}

			//if timestamp is defined
			if( isset( $parameters['timestamp'] ) ) {
				if( $this->validateDate( $parameters['timestamp'] ) ){
					if( isset($parameters['interval'] ) ) {
						//intervals assumed to be given in minutes
						$time_up = date('Y-m-d H:i:s', strtotime($parameters['timestamp']) + ( $parameters['interval'] * 60 ) ); // Add 1/2 hour
						$time_down = date('Y-m-d H:i:s', strtotime($parameters['timestamp']) - ( $parameters['interval'] * 60 ) ); 
					}else {
						//default interval 1hour
						$time_up = date('Y-m-d H:i:s', strtotime($parameters['timestamp']) + 1800 ); // Add 1/2 hour
						$time_down = date('Y-m-d H:i:s', strtotime($parameters['timestamp']) - 1800 ); 
					}
					$options['timestamp BETWEEN ? AND ?'] = array($time_down, $time_up) ;
				} else {
					return array(
						'success' => false,
						'msg' => 'Timestamp ex. 2018-03-24 00.05.15'
					);
				}
			}

			$destinations = $this->find('all', array(
	 				'conditions' =>  $options,
	 			)
	 		);

	 		return array (
				'success' => true,
				'data' => array( 'Destinations' => $destinations )
			);
		}else{
			return array(
				'success' => false,
				'msg' => 'Parameters not set'
			);
		}
	}

	public function canRequest($ip = null){	 	
	 	$log = ClassRegistry::init('Log');

	 	//counting all logs belonging to this ip, within the last hour
	 	$logs = $log->find('count', array(
	 		'conditions' => array(
	 				'ip' => $ip,
	 				'created >=' => date("Y-m-d H:i:s", strtotime("-1 hour") )
	 			),
	 		'order' => 'created DESC'
	 		)
	 	);

	 	if( $logs >= 10 ) {
	 		return false;
	 	}else{
	 		return true;
	 	}	 	
	
    }

	public function logAction( $ip = null ){	 	
	 	$log = ClassRegistry::init('Log');
	 	$log->create();
	 	$log->save( array(   
                    'ip' => $ip
            ));
    }

    function validNumbers( $numbers ){
    	foreach ($numbers as  $number) {
    		if( !is_numeric($number) ) {
    			return false;
    		}
    	}

    	return true;
    }

    function validateDate($date, $format = 'Y-m-d H:i:s')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
}