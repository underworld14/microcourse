const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    const token = await db.refresh_token.findOne({
      where: { token: req.body.refresh_token },
    });

    if (!token) {
      return res.status(400).json({
        status: "error",
        message: "invalid or expired token",
      });
    }

    const user = await token.getUser();

    return res.json({
      status: "ok",
      data: user,
      credentials: {
        refresh_token: token.token,
      },
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
