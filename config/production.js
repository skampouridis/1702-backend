module.exports = {
  server: {
    port: 4000 // Nodejs Server Port
  },
  dbImportCsv: process.cwd() + "/misc/ship_positions.csv",// Location of file with ship positions (used only by importCsv.js)
  db: {
    url: 'mongodb://' + process.env.MONGO_USER + ':' + process.env.MONGO_PASS + '@shiptrackingcluster-shard-00-00-vitzj.mongodb.net:27017,shiptrackingcluster-shard-00-01-vitzj.mongodb.net:27017,shiptrackingcluster-shard-00-02-vitzj.mongodb.net:27017/ship-tracking?ssl=true&replicaSet=ShipTrackingCluster-shard-0&authSource=admin'  //MongoDB connection URL
  },
  access: {
    limit: 10, //calls per (timeout) per user(ip)
    timeout: 3600 // Time (in seconds) that the server will look at for the limit restriction
  },
  userIpHeadersKey: 'x-forwarded-for' // the key in the header that holds the ip of the incoming connection
};
