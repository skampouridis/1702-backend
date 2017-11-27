module.exports = {
  server: {
    port: 4000 // Nodejs Server Port
  },
  dbImportCsv: process.cwd() + "/misc/ship_positions.csv", // Location of file with ship positions (used only by importCsv.js)
  db: {
    url: 'mongodb://localhost/ship-tracking' //MongoDB connection URL
  },
  access: {
    limit: 10, //calls per (timeout) per user(ip)
    timeout: 3600 // Time (in seconds) that the server will look at for the limit restriction
  },
  userIpHeadersKey: 'x-forwarded-for' // the key in the header that holds the ip of the incoming connection

};
