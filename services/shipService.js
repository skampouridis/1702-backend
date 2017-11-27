let helper = require('../helper/helper');
let _ = require("lodash");
let ShipPosition = require("../models/ShipPosition");
let config = require("config");
let UserError = require('../helper/UserError');

module.exports = {

  /**
   * Generates the Query Object, queries the DB and returns the results
   * @param mmsisCsv
   * @param lats
   * @param lons
   * @param datetimeFrom
   * @param datetimeTo
   * @param interval
   * @returns {Promise.<ShipPosition[]>}
   */
  getShips: async function (mmsisCsv, lats, lons, datetimeFrom, datetimeTo, interval) {
    let mmsiQ = this.getMmsiQuery(mmsisCsv);
    let geoQ = this.getGeoQuery(lats, lons);
    let datetimeQ = this.getDatetimeQuery(datetimeFrom, datetimeTo)
      , datetimeFromQ = datetimeQ.datetimeFromQ || null
      , datetimeToQ = datetimeQ.datetimeToQ || null;
    let intervalQ = this.getIntervalQ(interval, datetimeFrom);

    let shipPositions;
    //If interval is not set the process is simple just merge the query objects
    // (if any subquery Object is null, is omitted)
    if (!intervalQ) {
      let mongoQ = _.merge(mmsiQ, geoQ, datetimeFromQ, datetimeToQ);
      shipPositions = await ShipPosition.find(mongoQ, config.get("mongo.queryExclude"));
    }
    // If interval is set we have to build the aggregation query
    else {
      if (mmsiQ || geoQ || datetimeFromQ || datetimeToQ) {
        if (mmsiQ) intervalQ[0]['$match']['$and'].push(mmsiQ);
        if (geoQ) intervalQ[0]['$match']['$and'].push(geoQ);
        if (datetimeFromQ) intervalQ[0]['$match']['$and'].push(_.merge(datetimeFromQ, datetimeToQ));
      } else {
        delete intervalQ[0]['$match']['$and'];
      }
      shipPositions = await ShipPosition.aggregate(intervalQ);
    }
    return shipPositions;

  },
  /**
   * Generates the DB subquery for the MMSI
   * @param mmsisCsv
   * @returns { {$or: {mmsi: number}[]} | null }
   */
  getMmsiQuery: function (mmsisCsv) {
    let mmsis = mmsisCsv && mmsisCsv.split && mmsisCsv.split(';') || null;
    if (!mmsis) return null;
    let mmsisQ = {$or: []};
    mmsis.forEach((mmsi) => {
      mmsisQ['$or'].push({mmsi: helper.sanitizeField(mmsi)})
    });
    return mmsisQ;
  },

  /**
   * Generates the DB Subquery for the coordinates
   * @param latsCsv
   * @param lonsCsv
   * @returns { {lat: { $gte: number, $lte: number }, lon: { $gte: number, $lte: number } } | null }
   */
  getGeoQuery: function (latsCsv, lonsCsv) {
    let lats = latsCsv && latsCsv.split && latsCsv.split(';') || null;
    let lons = lonsCsv && lonsCsv.split && lonsCsv.split(';') || null;

    // If either lat or lon exist should both have length 2
    if ((lats || lons) && lats.length && lats.length !== 2) throw new UserError("Length of latitudes and longitudes should be 2");
    if ((lats || lons) && lons.length && lons.length !== 2) throw new UserError("Length of latitudes and longitudes should be 2");

    // If lat == lon (which is checked above) == null means that user didn't passed any coordinates;
    if (lats === null) return null;

    lats = lats.map(helper.sanitizeField).sort();
    lons = lons.map(helper.sanitizeField).sort();

    if (lats.some(helper.isNotNumeric) || lons.some(helper.isNotNumeric)) {
      throw new UserError("All geo coordinates should be numeric");
    }

    let geoQ = {lat: {$gte: lats[0], $lte: lats[1]}, lon: {$gte: lons[0], $lte: lons[1]}};

    return geoQ;
  },

  /**
   * Generates the DB Subquery for the timestamp
   * @param datetimeFrom
   * @param datetimeTo
   * @returns { {datetimeFromQ: { timestamp: { $gte: Date } }, datetimeToQ: { timestamp: { $gte: Date } } } | {datetimeFromQ: null, datetimeToQ: null} }
   */
  getDatetimeQuery: function (datetimeFrom, datetimeTo) {

    let datetimeQ = {datetimeFromQ: null, datetimeToQ: null};

    if (!datetimeFrom && !datetimeTo) return datetimeQ;
    if (!datetimeFrom || !datetimeTo)
      throw new UserError(`You must either not set datetimes or set both 'from' AND 'to' `);

    // Check Datetime Validation
    try {
      datetimeFrom = helper.formatDatetime(datetimeFrom);
      datetimeTo = helper.formatDatetime(datetimeTo);
    } catch (e) {
      throw new UserError(`Datetime is not in valid format, Valid formats are : ${ config.get("validation.date.formats").join(', ') } `);
    }
    if (datetimeFrom)
      datetimeQ.datetimeFromQ = {timestamp: {$gte: new Date(datetimeFrom)}};
    if (datetimeTo)
      datetimeQ.datetimeToQ = {timestamp: {$lte: new Date(datetimeTo)}};

    return datetimeQ;

  },

  /**
   * Builds the aggregation query object
   * @param interval
   * @param datetimeFrom
   * @returns {*}
   */
  getIntervalQ: function (interval, datetimeFrom) {
    if (interval && !helper.isNumeric(interval)) {
      throw new UserError("Interval parameter must be a number");
    } else if (!interval) {
      return null;
    }
    interval = helper.sanitizeField(interval);

    let datetimeFromObj;
    try {
      datetimeFrom = helper.formatDatetime(datetimeFrom);
      datetimeFromObj = new Date(datetimeFrom);
    } catch (e) {
      datetimeFromObj = new Date(0);
    }

    return [
      {
        $match: {
          $and: []
        }
      },
      {
        $project:
          {
            mmsi: 1, status: 1, speed: 1, lat: 1, lon: 1, course: 1, heading: 1, rot: 1, timestamp: 1,
            grp: {
              $let:
                {
                  vars: {delta: {$subtract: ["$timestamp", datetimeFromObj]}},
                  in: {
                    $subtract: [
                      "$$delta",
                      {
                        $mod: ["$$delta", (interval * 60 * 1000)]
                      }
                    ]
                  }
                }
            }
          }
      },
      {$sort: {timestamp: 1}},
      {
        $group: {
          _id: "$grp",
          mmsi: {$first: "$mmsi"},
          status: {$first: "$status"},
          speed: {$first: "$speed"},
          lat: {$first: "$lat"},
          lon: {$first: "$lon"},
          course: {$first: "$course"},
          heading: {$first: "$heading"},
          rot: {$first: "$rot"},
          timestamp: {$first: "$timestamp"},
        }
      }
    ]
  }
};



