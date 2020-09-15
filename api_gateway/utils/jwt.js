const { promisify } = require("util");
const jwt = require("jsonwebtoken");

exports.generateToken = async (payload) => {
  return await promisify(jwt.sign)(payload, process.env.APP_SECRET);
};
