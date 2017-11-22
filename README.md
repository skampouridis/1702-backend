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

**The API must:**
* filterable by: **MMSI**, single or multiple, **latitude** and **longitude range**, as well as **time interval**.
* log incoming requests to a datastore of  your choise (plain text, database, third party service etc.)
* limit requests per user to **10/hour**. (Use the request remote IP as a user identifier)
* accept an input parameter that defines output format, in **JSON**, **XML** or **CSV**.

Stage your solution on a demo page, fork this repo and create a pull request that contains your implementation in a new branch named after you.

# RESTful API Implementation 

**Issue**: STATION: receiving station ID was missing from the csv file. Thus, the vesselTrack model does not have this property.

Our API has been developed with the **Laravel 5.5** framework and implemented with a Domain Driven Design (**DDD**) 
approach (layered architecture). The API has been tested in a local dev environment, a Vagrant box (scotchbox) 
with the following features included:

* **Ubuntu 14.04**
* **PHP 7.0.19!**
* **MySQL 5.5.55!** 
* **Apache 2.4.16** 

##API requests

The API only accepts the GET HTTP method and requires to have in the requests headers an api-version header which will
determine the version of the API. This approach was followed in order to serve the fundamentals of REST. 
For example, if we want to create a version 2 API then the URL's will remain the same and only the header should be updated.

##Middlewares

The following middlewares have been developed to serve the implementation requirements

* **ApiRequestHeader**: Handles an incoming request and accepts only the requests with a GET HTTP method
* **ApiVersioning**:  Handles an incoming request and transforms the URL based on the headers api-version
* **RateLimiter**:  Handles an incoming request and checks the requests/hour for each user ip.
It returns the rate limit headers along with the response or an error if the limit exceeded.

##Routes

Work with the following routes to fetch the vessel tracks from the data source:
(don't forget to include the api-version in the request headers)

* **<host>/api/vesseltrack/**: Get all vessel tracks
* **<host>/api/vesseltrack/mmsi/{mmsi}**: Get all vessel tracks by mmsi. 
For multiple mmsi numbers use a comma separator e.g <host>/api/vesseltrack/mmsi/247039300,311040700
* **<host>/api/vesseltrack/time/{from},{to}**: Get all vessel tracks for a time interval. Define the from
datetime and to datetime in timestamp format. e.g <host>/api/vesseltrack/mmsi/1487402319,1487413119
* **<host>/api/vesseltrack/coordinates/{from},{to}**: Get all vessel tracks for a latitude and longitude range. 
Define 2 points like the following format and get the records e.g <host>/api/vesseltrack/coordinates/lon:15lat:42/lon:16.43227lat:41.75063

##Api Structure

The API implementation is located under the App\Api namespace. Only the configuration file apimodule.php is located 
under the laravel config folder. This file will be used from service providers so that they can read the enabled projects 
and modules and load the relevant service providers automatically.

####Providers

Two services providers located in App\Api\v1\Core\App\Providers are responsible to load all routes and module service 
providers into the application. These providers must be registered in the application first, so they have to be placed
under the config/app.php file.

* **ModulesServiceProvider**: Responsible for the auto registration of all module service providers. Currently 
is only one (VesselTrackServiceProvider)

* **RouteServiceProvider**: Responsible to include api routes for each project or module. For this API, it includes the 
Core and VesselTrack routes. The routes live under the Application layer, in the routes folder.

####Exceptions

The following custom exceptions created to catch API exceptions and render automatically a json response.

***InvalidApiVersion**: This exception is returned when a user sends an invalid API version through the HTTP Header api-version.

***InvalidRequestMethod**: This exception returned when a user sends an invalid HTTP method

***InvalidRequestParameter**: This exception returned when the user performs invalid requests

***InvalidValueObject**: This exception returned from the value objects validator method.

***RateLimit**: This exception returned from the RateLimit middleware when the user consumed the requests/hour restriction.

####Parsers

Responsible to parse the vessel tracks data and return them in a specific format based on the input parameter that defines the output format.
The parsers are utilized from the ApiDataParser class.

***Xmlparser**: Converts the vessel tracks array into xml format

***CsvParser**: Converts the vessel tracks array into csv format

***JsonParser**: Nothing implemented in this parser. Laravel transforms the array into json response automatically.

####v1

Separated into 2 namespaces (projects). The Core and the MarineTraffic. 

The **Core** includes all files that our api version 
needs to have to work properly. For example it includes the general value objects (mmsi,longitude,latitude), some interfaces
(RequestValitaror,ApiRepository) that determine which methods (business needs) the module classes must implement 
(infrastructure). 

**MarineTraffic** project hosts the **VesselTrack** module. This module is divided into 3 layers (DDD).

***App (Application)**: Includes the Controllers, Service providers and the routes of the module.

***Domain (Business logic)**: Includes Models, Repositories and Request validators of the module. This layer designed
as an isolation layer, which means the business logic and rules (validations) should not be affected with any other implementation
from the other two layers. The same philosophy followed in the Core project.

***Infrustructure(interact with data store)**: Includes the implementation of the repositories using the laravel Eloquent ORM.

For any information/comments please contact at gianngnk@gmail.com 





                 
    

