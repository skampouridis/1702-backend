dimitriosDesyllas
=================

A simple API for retrieving ship routes.

#Installation

In order to install successfully the application you must:

1. Ensure that all requirements are ok
2. Configure the application and install all the dependencies
3. Generate the database

## 1. Php modules - Infastructure required

In order to run you must have installed `php-sqlite` and `php-redis` php modules also a redis server is required in order to run the application. 

## 2. Configure and install Dependencies

On `app/config/parameters.yml.dist` set the value `redis_dns` with the url of your redis server. The value must have the `redis://^redis_url^` format where `^redis_url^` is the url or the ip or the redis server.

Afterwards run `composer install` to install the dependencies.

## 3. Generating Database and Schema

1. Create the `./var/db` folder with `777` UNIX permissions.
2. Run `php bin/console doctrine:database:create` to create the database.
3. Run `php bin/console doctrine:schema:create` to create the schema.
4. Run `php bin/console data:insert:csv ../ship_positions.csv` to import the data.


# Run the application

From a console run 

```
cd ^folder_to_the_application^
php ./bin/console server:run
```

# API Enpoint explanation

## General

### Http response codes

Http Code | Cases
--- | ---
400 | When extra parameters are given or non correctly-formated parameters are given
500 | When an internal error occurs
405 | When you try to access the endpoint in any other method that the endpoint does not support
404 | When to data have been fetched

### <a id="input_parameters"></a>Input Parameters

All api Endpoints support the following parameters.

name | optional | explanation
---  | --- | ---
mmsi | YES | The vesels mmsi
longtitude_min | YES | From what gps longtitude you want to fetch the data
longtitude_max | YES | Until what longtitude you want to fetch the data
latitude_min | YES | From what gps latitude you want to fetch the data
latitude_max | YES | Until what latitude you want to fetch the data
date_from | YES | From what date in `YYY-mm-dd HH:mm` (in php `Y-m-d H:i` ) you want to fetch the data.*
date_to | YES | Until what date you want to fetch the routes in `YYY-mm-dd HH:mm` (in php `Y-m-d H:i` ) you want to fetch the data.*

* Misformated dates will return an http response with status code `400`

## Endoint description

### /routes.json 
Retreives the vessel routes formated as json

#### Allowed Http methods
Http `GET` and http `HEAD` (reiminder http `HEAD` does not return the content)

#### Input Parameters

The parameters are the same as provided in [parameters]("#input_parameters").

### /routes.csv 
Retreives the vessel routes formated as csv.

#### Allowed Http methods
Http `GET` and http `HEAD` (reiminder http `HEAD` does not return the content)

#### Input Parameters

The parameters are the same as provided in [parameters]("#input_parameters").

 ### /routes.json 
Retreives the vessel routes formated as json

#### Allowed Http methods
Http `GET` and http `HEAD` (reiminder http `HEAD` does not return the content)

#### Input Parameters

The parameters are the same as provided in [parameters]("#input_parameters").
 