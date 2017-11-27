let express = require('express');
let router = express.Router();

router.get('/', function (req, res) {
  res.json({title: 'Ship Tracking', text: 'Welcome to Ship Tracking API'});
});

module.exports = router;
