# Ship Tracking API

## API Endpoints
* /ships
* /ships/:mmsi (one or multi seperated by ';')

## Both endpoints accept these GET parameters :

* **lat** *Latitude* accepting 2 parameters (min and max) seperated by ';' (if used, "lon" parameter is mandatory)
* **lon** *Longitude* accepting 2 parameters (min and max) seperated by ';' (if used, "lat" parameter is mandatory)
* **from** *Datetime From* (if used, "to" parameter is mandatory)
* **to** *Datetime To* (if used, "form" parameter is mandatory)
* **format** *response format* available options is "xml", "csv" -- if none used defaults to json
* **interval** Number, minimum "time distance" *in minutes* that the records(the timestamp variable) should have with each other.

* The **/ships** endpoint accepts a **mmsi** GET parameter

> All Parameters can be mixed and matched

> The accepted datetime format of the **from** and **to** parameters can be configured in the config/default.js configuration file

> All floating point numbers in the parameters can accept both *comma* and *period* as a decimal place seperator... just in case....

> The request limit per user can be configured in the *config/[development/production].js* file


## Live Server
* Url: http://mt.gremp.eu/
> The applicaton runs behind nginx server that proxies all requests to the nodeJS server


###### Example Queries
* http://mt.gremp.eu/ships/247039300 _Search for a single MMSI_
* http://mt.gremp.eu/ships/311040700;311486000 _Search for multiple MMSI_
* http://mt.gremp.eu/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000 _Search for a single MMSI with datetime range_
* http://mt.gremp.eu/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000&lat=13.464;14.267&lon=43.264;44.267 _Search for a single MMSI with datetime range and coordinates_
* http://mt.gremp.eu/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=xml _get results in XML format_
* http://mt.gremp.eu/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=csv _get results in CSV format_
* http://mt.gremp.eu/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000&lat=13.464;14.267&lon=43.264;44.267&interval=3 _search with interval_


## Technical

* **Server:** NodeJS (Used Version 9.2.0)
* **Language:** Javascript
* **Database:** MongoDB
* **Framework:** ExpressJS
* **Libraries Used:** Mongoose, Lodash, Moment, Async, Morgan, Config, Object-to-xml, Mocha, Chai, Supertest, fast-csv


## Installation Instructions

* Clone the project
* run **npm install**
* configure db in the config/[development, production].js
* if needed to import the given data in the db run **NODE_ENV=[development/production] npm run import-db**
* test the application via **NODE_ENV=[development/production] npm run test**
* launch the application via **NODE_ENV=[development/production] npm run start**


## Comments / Thoughts
> For the user restriction limit I used mongoDB with ttl on the records on the same Mongo Server (for simplicity) that I use for the rest of the application.
> In a production environment I would use a separate server,
> either MongoDB or Aerospike or some similar DB Server/Cache Server that implements inMemory storage and ttl.

> In the project specification page, in the "columns supplied" section a "STATION" field is mentioned but is missing from the csv file

> In the API I've added both **datetime range** and **time interval** filters because,
> since there was no extra information on how the time interval should work
> (there are a few options on how it could work), I assumed that it was a "typo" and it meant to say daytime range.
> So I implemented both versions, just to be on the safe side...



> I hope you enjoyed my approach on the project

> I'll be more than happy to answer any questions

> George
