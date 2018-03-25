<?php
if( !empty($response['data']['Destinations']) ) {
	foreach ($response['data']['Destinations'] as $value) {
		echo !empty($value['Destination']['mmsi']) ? $value['Destination']['mmsi'].';' : 'NULL;';
		echo $value['Destination']['status'].';';
		echo !empty($value['Destination']['speed']) ? $value['Destination']['speed'].';' : 'NULL;';
		echo !empty($value['Destination']['lon']) ? $value['Destination']['lon'].';' : 'NULL;';
		echo !empty($value['Destination']['lat']) ? $value['Destination']['lat'].';' : 'NULL;';
		echo !empty($value['Destination']['course']) ? $value['Destination']['course'].';' : 'NULL;';
		echo !empty($value['Destination']['heading']) ? $value['Destination']['heading'].';' : 'NULL;';
		echo !empty($value['Destination']['rot']) ? $value['Destination']['rot'].';' : 'NULL;';
		echo !empty($value['Destination']['timestamp']) ? $value['Destination']['timestamp'].'<br/>' : 'NULL';
	}
}
?>