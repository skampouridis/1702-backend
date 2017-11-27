let express = require('express');
let logger = require('morgan');
let home = require('./routes/home');
let ships = require('./routes/ships');
let mongoose = require("mongoose");
let config = require("config");
let app = express();

let interceptor = require("./services/interceptor");

interceptor.before(app);

app.use(logger('dev'));


app.use('/', home);
app.use('/ships', ships);

interceptor.after(app);


let mongoUrl = config.get('db.url');
mongoose.connect(mongoUrl, {useMongoClient: true});
mongoose.Promise = global.Promise;

process.on("SIGTERM", gracefullShutdown);
process.on("SIGINT", gracefullShutdown);


async function gracefullShutdown(code) {
  console.log("Got shutdown signal with code: " + (code || 0));
  mongoose.connection.close(function () {
    console.log('Mongoose disconnected...');
    process.exit();
  });


}


module.exports = app;
