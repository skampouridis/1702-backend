let mongoose = require('mongoose');
let dbTypes = mongoose.Schema.Types;
let schema = new mongoose.Schema({
  url: dbTypes.String,
  params: dbTypes.Object,
  ip: dbTypes.String,
  headers: dbTypes.Object,
  timestamp: {type: dbTypes.Date, default: Date.now},
}, {collection: 'access-log', versionKey: false});

let AccessLog = mongoose.model('AccessLog', schema);

module.exports = AccessLog;