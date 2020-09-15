const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    await db.refresh_token.destroy({
      where: { token: req.body.refresh_token },
    });
    return res.json({
      status: "ok",
      message: "successfull logout user",
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
