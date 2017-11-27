let mongoose = require('mongoose');
let dbTypes = mongoose.Schema.Types;
let schema = new mongoose.Schema({
  mmsi: {type: dbTypes.Number, index: true},
  status: dbTypes.Number,
  speed: dbTypes.Number,
  lat: {type: dbTypes.Number, index: true},
  lon: {type: dbTypes.Number, index: true},
  course: dbTypes.Number,
  heading: dbTypes.Number,
  rot: dbTypes.Number,
  timestamp: {type: dbTypes.Date, index: true}
}, {collection: 'ship-positions', versionKey: false});

let ShipPosition = mongoose.model('ShipPosition', schema);

module.exports = ShipPosition;