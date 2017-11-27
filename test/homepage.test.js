let request = require('supertest')
  , app = require("../app");


describe("Homepage", function () {
  it("welcomes the user", function (done) {
    request(app).get("/")
      .expect(200)
      .expect(/Ship Tracking/)
      .end(function (err, res) {
        done();
      })
  })
});


