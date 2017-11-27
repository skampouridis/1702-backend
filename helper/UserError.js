/**
 * We define a new type of error so when a new UserError occurs
 * to show the error to the the client else we show a generic error
 * @param message
 * @constructor
 */
function UserError(message) {
  this.name = 'UserError';
  this.message = message;
  this.stack = (new Error()).stack;
}

UserError.prototype = new Error;

module.exports = UserError;