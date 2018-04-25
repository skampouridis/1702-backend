# Vessels Tracks API 

Your task is to create a **RESTful API** that serves vessel tracks from a raw vessel positions data-source.
The raw data is supplied as a CSV file that you must import to a database schema of your choice. Columns supplied are:

* **MMSI**: unique vessel identifier
* **STATUS**: AIS vessel status
* **STATION**: receiving station ID
* **SPEED**: speed in knots x 10 (i.e. 10,1 knots is 101)
* **LON**: longitude
* **LAT**: latitude
* **COURSE**: vessel's course over ground
* **HEADING**: vessel's true heading
* **ROT**: vessel's rate of turn
* **TIMESTAMP**: position timestamp

**The API end-point must:**
* Be filterable by: 
  * **MMSI** (single or multiple) 
  * **latitude** and **longitude range**
  * as well as **time interval**.
* Log incoming requests to a datastore of  your choise (plain text, database, third party service etc.)
* Limit requests per user to **10/hour**. (Use the request remote IP as a user identifier)
* Define a content negotiation parameter that defines output format, in **JSON**, **XML** or **CSV**.

**Share your work:**
* Stage your solution on a demo page or
* Fork this repo and create a pull request that contains your implementation in a new branch named after you.

**Have fun!**