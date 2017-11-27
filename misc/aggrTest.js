let ShipPositionModel = require("../models/ShipPosition");
let mongoUrl = 'mongodb://localhost/ship-tracking';
let mongoose = require("mongoose");
mongoose.connect(mongoUrl, {useMongoClient: true});
mongoose.Promise = global.Promise;
let moment = require("moment");
(async function () {
  let a = [
    {
      $match: {
        $and: [
          {
            timestamp: {
              $gte: new Date("2017-02-18 02:02:16.000"),
              $lte: new Date("2017-02-18 02:54:16.000")
            }
          },
          {
            $or: [{mmsi: 247039300}]
          }
        ]
      }
    },
    {
      $project:
        {
          mmsi: 1, status: 1, speed: 1, lat: 1, lon: 1, course: 1, heading: 1, rot: 1, timestamp: 1,
          grp: {
            $let:
              {
                vars: {delta: {$subtract: ["$timestamp", new Date(0)]}},
                in: {$subtract: ["$$delta", {$mod: ["$$delta", 180 * 1000]}]}
              }
          }
        }
    },
    {$sort: {timestamp: 1}},
    {
      $group: {
        _id: "$grp",
        mmsi: {$first: "$mmsi"},
        status: {$first: "$status"},
        speed: {$first: "$speed"},
        lat: {$first: "$lat"},
        lon: {$first: "$lon"},
        course: {$first: "$course"},
        heading: {$first: "$heading"},
        rot: {$first: "$rot"},
        timestamp: {$first: "$timestamp"},
      }
    }
  ];

  let b = [
    {
      "$match": {
        "$and": [
          {
            "$or": [
              {
                "mmsi": "247039300"
              }
            ]
          }
        ]
      }
    },
    {
      "$project": {
        "mmsi": 1,
        "status": 1,
        "speed": 1,
        "lat": 1,
        "lon": 1,
        "course": 1,
        "heading": 1,
        "rot": 1,
        "timestamp": 1,
        "grp": {
          "$let": {
            "vars": {
              "delta": {
                "$subtract": [
                  "$timestamp",
                  new Date(0)
                ]
              }
            },
            "in": {
              "$subtract": [
                "$$delta",
                {
                  "$mod": [
                    "$$delta",
                    180000
                  ]
                }
              ]
            }
          }
        }
      }
    },
    {
      "$sort": {
        "timestamp": 1
      }
    },
    {
      "$group": {
        "mmsi": {
          "$first": "$mmsi"
        },
        "status": {
          "$first": "$status"
        },
        "speed": {
          "$first": "$speed"
        },
        "lat": {
          "$first": "$lat"
        },
        "lon": {
          "$first": "$lon"
        },
        "course": {
          "$first": "$course"
        },
        "heading": {
          "$first": "$heading"
        },
        "rot": {
          "$first": "$rot"
        },
        "timestamp": {
          "$first": "$timestamp"
        }
      }
    }
  ];


  let res = await ShipPositionModel.aggregate(a);


  let dateArr = res.map(rec => {
    return rec.timestamp.getTime()
  })
  dateArr = dateArr.sort();
  dateArr = dateArr.map(rec => {
    return moment(rec).format("YYYY-MM-DD HH:mm:ss")
  });


  let res2 = await ShipPositionModel.find({
    mmsi: 247039300
  })
  let dateArr2 = res2.map(rec => {
    return rec.timestamp.getTime()
  })
  dateArr2 = dateArr2.sort();
  dateArr2 = dateArr2.map(rec => {
    return moment(rec).format("YYYY-MM-DD HH:mm:ss")
  });

  console.log(dateArr, dateArr2);


})()

