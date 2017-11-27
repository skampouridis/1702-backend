let AccessLogModel = require("../models/AccessLog");
let IpAccessLogModel = require("../models/IpAccessLog");
let ErrorLogModel = require("../models/ErrorLog");
let config = require("config");
let UserError = require("../helper/UserError");

module.exports = {
  /**
   * Mounts all the middleware that should be executed before the Routes middleware
   * @param app
   */
  before: function (app) {

    // Write all incoming requests to DB
    // and add the users ip to IpAccessLog collection in DB
    app.use(function (req, res, next) {
      if (req.headers['x-forwarded-for']) {
        new IpAccessLogModel({ip: req.headers[config.get('userIpHeadersKey')]}).save();
      }
      new AccessLogModel({
        url: req.url,
        params: req.params,
        headers: req.headers
      }).save();
      next();
    });

    // Check if user has reached the access Limits
    app.use(async function (req, res, next) {
      let countAccess = await IpAccessLogModel.count({ip: req.headers[config.get('userIpHeadersKey')]})
        .catch(next);

      // If user has reached the access limits throw error else continue
      if (countAccess > config.get("access.limit")) {
        next(new UserError("Limits exceeded. Try again later..."));
      } else {
        next();
      }

    });
  },

  /**
   * Mounts all the middleware that should be executed after the Routes middleware
   * @param app
   */
  after: function (app) {
    // catch 404 and forward to error handler
    app.use(function (req, res, next) {
      let err = new UserError('Not Found');
      err.status = 404;
      next(err);
    });

    // error handler
    app.use(function (err, req, res, next) {
      // set locals, only providing error in development
      res.locals.message = err.message;
      res.locals.error = req.app.get('env') === 'development' ? err : {};

      ErrorLogModel({
        url: req.url,
        params: req.params,
        headers: req.headers,
        message: err.message,
        stack: err.stack,
        errorType: err.name
      }).save();

      // render the error page
      res.status(err.status || 500);
      let response = {error: "Internal Error. Something went wrong. Please try again later"};
      if (err.name === "UserError") {
        response = {error: err.message};
      }
      res.json(response);
    });


  }
};


