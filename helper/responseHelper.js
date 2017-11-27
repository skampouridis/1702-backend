const async = require("async");
const moment = require("moment");
const o2x = require("object-to-xml");
const json2csv = require('json2csv');


module.exports = {
  /**
   * Gets the ship positions converts them to object and creates the CSV string to serve
   * @param shipPositions {ShipPosition[]}
   * @returns {Promise<string>}
   */
  convertForCsv: async function (shipPositions) {

    let shipPosObjects = await this.convertMongoObjToObj(shipPositions);
    let fields = ['mmsi', 'status', 'speed', 'lon', 'lat', 'course', 'heading', 'rot', 'timestamp'];
    let fieldNames = ['MMSI', 'STATUS', 'SPEED', 'LON', 'LAT', 'COURSE', 'HEADING', 'ROT', 'TIMESTAMP'];
    let opts = {
      data: shipPosObjects,
      fields: fields,
      fieldNames: fieldNames,
      del: ';'
    };
    let csv = json2csv(opts);

    return csv;


  },
  /**
   * Gets the ship positions converts them to object and creates the XML string to serve
   * @param shipPositions {ShipPosition[]}
   * @returns {Promise<string>}
   */
  convertForXML: async function (shipPositions) {

    let shipPosObjects = await this.convertMongoObjToObj(shipPositions);
    let xml = o2x({
      '?xml version="1.0" encoding="utf-8"?': null,
      'ship-positions': {position: shipPosObjects}
    });
    return xml;
  },

  /**
   * Coverts asynchronously the shipPosition Mongoose object to plain Objects
   * so when transformed to CSV or XML not to get special parameters that the Mongoose Object contains
   * @param shipPositions {ShipPosition[]}
   * @returns {Promise<Object[]>}
   */
  convertMongoObjToObj: async function (shipPositions) {
    return new Promise(
      function (resolve, reject) {
        let shipObjects = [];
        async.each(shipPositions,
          async (shipPos) => {
            let shipObj = shipPos.toObject();
            shipObj.timestamp = moment(shipObj.timestamp).format("YYYY-MM-DD HH:mm:ss.SSS");
            shipObjects.push(shipObj);
          },
          (err) => {
            if (err) return reject(err);
            resolve(shipObjects);
          });

      }
    )

  }
};