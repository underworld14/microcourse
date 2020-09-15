const makeToken = require("../utils/makeToken");
const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    const refreshToken = makeToken(90);
    const token = await db.refresh_token.create({
      userId: req.body.userId,
      token: refreshToken,
    });
    return res.status(201).json({
      status: "ok",
      data: token,
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
