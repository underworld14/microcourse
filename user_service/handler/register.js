const bcrypt = require("bcryptjs");
const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    let { email, name, password, occupation, role } = req.body;
    if (!role) role = "user";
    password = await bcrypt.hash(password, 12);
    const data = await db.user.create({
      email,
      name,
      password,
      occupation,
      role,
    });
    return res.json({ status: "ok", data });
  } catch (error) {
    errorResponse(res, error);
  }
};
