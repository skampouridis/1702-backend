let express = require('express');
let router = express.Router();
let shipService = require("../services/shipService");
let responseHelper = require("../helper/responseHelper");

router.get('/', async function (req, res, next) {
  let mmsi = req.query.mmsi || null;
  await serveShipPositions(mmsi, req, res, next);
});

router.get('/:mmsi', async function (req, res, next) {
  let mmsi = req.params.mmsi || null;
  await serveShipPositions(mmsi, req, res, next);
});

/**
 * Gathers all the parameters needed, queries the DB
 * and renders the results according to format parameter
 * @param mmsi
 * @param req
 * @param res
 * @param next
 * @returns {Promise.<void>}
 */
async function serveShipPositions(mmsi, req, res, next) {
  let lat = req.query.lat || null;
  let lon = req.query.lon || null;
  let datetimeFrom = req.query.from || null;
  let datetimeTo = req.query.to || null;
  let interval = req.query.interval || null;

  let format = req.query.format || null;

  let shipPositions = await shipService.getShips(mmsi, lat, lon, datetimeFrom, datetimeTo, interval)
    .catch(next);

  switch (format) {
    case "csv":
      res.set('Content-Type', 'text/csv');
      let shipsForCsv = await responseHelper.convertForCsv(shipPositions);
      res.send(shipsForCsv);
      break;
    case "xml":

      res.set('Content-Type', 'text/xml');
      let shipsXML = await responseHelper.convertForXML(shipPositions);
      res.send(shipsXML);
      break;
    default:
      res.json(shipPositions);
  }

}


module.exports = router;
