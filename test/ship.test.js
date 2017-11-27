const request = require('supertest')
  , app = require("../app")
  , expect = require("chai").expect
  , xml = require('fast-xml-parser')
  , parse = require('csv-parse');





describe("Ship Tracking API", function () {

  it("[JSON] Should gets all records", function (done) {
    request(app).get("/ships")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(2696);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of a MMSI (with 869 records)", function (done) {
    request(app).get("/ships?mmsi=247039300")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(869);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of a MMSI from MMSI endpoint (with 869 records)", function (done) {
    request(app).get("/ships/247039300")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(869);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of multi MMSI (with 1827 records)", function (done) {
    request(app).get("/ships?mmsi=311040700;311486000")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(1827);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of multi MMSI from MMSI endpoint (with 1827 records)", function (done) {
    request(app).get("/ships/311040700;311486000")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(1827);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of a MMSI and Date Range (110 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(110);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of a MMSI and Date Range from MMSI endpoint (110 records)", function (done) {
    request(app).get("/ships/247039300?from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(110);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of Date Range (381 records)", function (done) {
    request(app).get("/ships?from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(381);
        res.destroy();
        done();
      });
  });


  it("[JSON] Should gets all records of a MMSI Geolocation and Date Range (75 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(75);
        res.destroy();
        done();
      });
  })

  it("[JSON] Should gets all records of a MMSI Geolocation and Date Range from MMSI endpoint (75 records)", function (done) {
    request(app).get("/ships/247039300?from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(75);
        res.destroy();
        done();
      });
  })


  it("[XML] Should gets all records of a MMSI Geolocation and Date Range (75 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=xml")
      .expect(200)
      .end(function (err, res) {
        let jsonObj = xml.parse(res.text);
        expect(jsonObj['ship-positions'].position.length)
          .to.equal(75);
        res.destroy();
        done();
      });
  })

  it("[XML] Should gets all records of a MMSI Geolocation and Date Range from MMSI endpoint (75 records)", function (done) {
    request(app).get("/ships/247039300?from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=xml")
      .expect(200)
      .end(function (err, res) {
        let jsonObj = xml.parse(res.text);
        expect(jsonObj['ship-positions'].position.length)
          .to.equal(75);
        res.destroy();
        done();
      });
  })

  it("[CSV] Should gets all records of a MMSI Geolocation and Date Range (75 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=csv")
      .expect(200)
      .end(function (err, res) {
        parse(res.text, {delimiter: ';', from: 2}, function (err, output) {
          expect(err).to.equal(null);
          expect(output.length)
            .to.equal(75);
          res.destroy();
          done();
        })
      });
  })

  it("[CSV] Should gets all records of a MMSI Geolocation and Date Range from MMSI endpoint (75 records)", function (done) {
    request(app).get("/ships/247039300?from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267&format=csv")
      .expect(200)
      .end(function (err, res) {
        parse(res.text, {delimiter: ';', from: 2}, function (err, output) {
          expect(err).to.equal(null);
          expect(output.length)
            .to.equal(75);
          res.destroy();
          done();
        })
      });
  });


  it("[JSON] Should gets all records of a MMSI and interval (with 351 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&interval=3")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(351);
        res.destroy();
        done();
      });
  });


  it("[JSON] Should gets all records of multi MMSI  and interval (with 463 records)", function (done) {
    request(app).get("/ships?mmsi=311040700;311486000&interval=3")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length).to.equal(463);
        res.destroy();
        done();
      });
  });

  it("[JSON] Should gets all records of a MMSI and Date Range  and interval (52 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17%2022:19:22.000&to=2017-02-18%2005:19:39.000&interval=3")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(52);
        res.destroy();
        done();
      });
  });


  it("[JSON] Should gets all records of Date Range  and interval (104 records)", function (done) {
    request(app).get("/ships?from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&interval=3")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(104);
        res.destroy();
        done();
      });
  });


  it("[JSON] Should gets all records of a MMSI Geolocation and Date Range  and interval (32 records)", function (done) {
    request(app).get("/ships?mmsi=247039300&from=2017-02-17 22:19:22.000&to=2017-02-18 05:19:39.000&lat=13.464;14.267&lon=43.264;44.267&interval=3")
      .expect(200)
      .end(function (err, res) {
        let data = JSON.parse(res.text);
        expect(data.length)
          .to.equal(32);
        res.destroy();
        done();
      });
  })


});
