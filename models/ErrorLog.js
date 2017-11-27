let mongoose = require('mongoose');
let dbTypes = mongoose.Schema.Types;
let schema = new mongoose.Schema({
  url: dbTypes.String,
  params: dbTypes.Object,
  ip: dbTypes.String,
  headers: dbTypes.Object,
  timestamp: {type: dbTypes.Date, default: Date.now},
  message: dbTypes.String,
  stack: dbTypes.String,
  errorType: dbTypes.String
}, {collection: 'error-log', versionKey: false});

let ErrorLog = mongoose.model('ErrorLog', schema);

module.exports = ErrorLog;