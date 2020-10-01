const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    const data = await db.user.findByPk(req.params.id, {
      attributes: { exclude: ["password"] },
    });

    if (!data) {
      return res.status(404).json({
        status: "error",
        message: "user not found",
      });
    }

    return res.json({
      status: "ok",
      data,
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
