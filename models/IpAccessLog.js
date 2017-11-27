let mongoose = require('mongoose');
let dbTypes = mongoose.Schema.Types;
let config = require("config");

let schema = new mongoose.Schema({
  ip: {type: dbTypes.String, index: true},
  timestamp: {type: dbTypes.Date, default: Date.now, expires: config.get("access.timeout")},
}, {collection: 'ip-access-log', versionKey: false});

let IpAccessLog = mongoose.model('IpAccessLog', schema);

module.exports = IpAccessLog;