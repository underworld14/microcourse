const bcrypt = require("bcryptjs");
const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    let { email, password } = req.body;
    const user = await db.user.findOne({
      where: { email },
    });

    if (!user) {
      return res.status(400).json({
        status: "error",
        message: "email is not available",
      });
    }

    const compared = await bcrypt.compare(password, user.password);

    if (!compared) {
      return res.status(400).json({
        status: "error",
        message: "email or password wrong",
      });
    }

    return res.json({
      status: "ok",
      data: user,
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
