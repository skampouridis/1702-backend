/**
 * Imports the csv that is declared in the config file (param: dbImportCsv) to mongoDB
 */
let ShipPosition = require("../models/ShipPosition");
let parser = require("fast-csv");
let config = require("config");
let fs = require('fs');
let mongoose = require('mongoose');
let helper = require('../helper/helper');

(function () {
  let mongoUrl = config.get('db.url');
  mongoose.connect(mongoUrl, {useMongoClient: true});
  mongoose.Promise = global.Promise;


  //Create a readable stream
  let stream = fs.createReadStream(config.get('dbImportCsv'));

  let options = {
    headers: [
      'mmsi',
      'status',
      'speed',
      'lat',
      'lon',
      'course',
      'heading',
      'rot',
      'timestamp',
    ],
    delimiter: ';',
    renameHeaders: true
  };
  let savePromises = [];

  // Read the stream and insert records to db
  parser
    .fromStream(stream, options)
    .on("data", async function (data) {

      // Convert data in order to inserted in the db
      let sp = new ShipPosition({
        mmsi: helper.sanitizeField(data.mmsi),
        status: helper.sanitizeField(data.status),
        speed: helper.sanitizeField(data.speed),
        lat: helper.sanitizeField(data.lat),
        lon: helper.sanitizeField(data.lon),
        course: helper.sanitizeField(data.course),
        heading: helper.sanitizeField(data.heading),
        rot: helper.sanitizeField(data.rot),
        timestamp: data.timestamp,
      });
      savePromises.push(sp.save());
    })

    .on("end", async function () {
      //When done close the db connection
      await Promise.all(savePromises);
      mongoose.disconnect();
    });


})();