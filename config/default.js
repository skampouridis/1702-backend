module.exports = {
  validation: {
    date: {
      formats: ["YYYY-MM-DD", "YYYY-MM-DD HH:mm", "YYYY-MM-DD HH:mm:ss", "YYYY-MM-DD HH:mm:ss.SSS"] // Valid formats for datetime range query
    }
  },
  mongo: {
    queryExclude: {_id: 0, __v: 0} // Omit those fields when query DB
  }
};