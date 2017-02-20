# 1702-backend

Your task is to create a restful API that serves vessel tracks from a raw vessel positions datasource.
The raw data is supplied as a CSV file that you must import to a database schema of your choice. Columns supplied are:

MMSI: unique vessel identifier
STATUS: AIS vessel status
STATION: receiving station ID
SPEED: speed in knots x 10 (i.e. 10,1 knots is 101)
LON: longitude
LAT: latitude
COURSE: vessel's course over ground
HEADING: vessel's true heading
ROT: vessel's rate of turn
TIMESTAMP: position timestamp

The API should be filterable by MMSI, single or multiple, latitude and longitude range, as well as time interval.
The API should also log and limit requests per user to 10/hour. You can use the request remote IP as a user identifier.
The API should accept an input parameter that defines output format, in JSON, XML or CSV.

Stage your solution on a demo page, fork this repo and create a pull request that contains your implementation in a subfolder.
