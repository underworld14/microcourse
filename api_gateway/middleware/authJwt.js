const jwt = require("express-jwt");

module.exports = jwt({ secret: process.env.APP_SECRET, algorithms: ["HS256"] });
