let moment = require('moment');
let config = require('config');
let UserError = require("./UserError");

module.exports = {
  /**
   * Converts the fields to the appropriate type
   * replaces the decimal point from , to .
   * and parses the number... if NaN then return null
   * @param val
   * @returns {number | null}
   */
  sanitizeField: function (val) {
    val = val.replace(',', '.');
    if (module.exports.isNumeric(val)) {
      return parseFloat(val);
    }
    return null;
  },

  /**
   * Checks if a variable is a number
   * @param n
   * @returns {boolean}
   */
  isNumeric: function (n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
  },
  /**
   * Checks if a variable is a not number
   * @param n
   * @returns {boolean}
   */
  isNotNumeric: function (n) {
    return !module.exports.isNumeric(n);
  },

  formatDatetime(dateString) {
    let date = moment(dateString, config.get("validation.date.formats"), true);
    if (!date.isValid()) throw new UserError("Datetime is not valid");
    return date.format("YYYY-MM-DD HH:mm:ss.SSS");
  }
};