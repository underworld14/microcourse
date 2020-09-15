const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    const data = await db.user.findByPk(req.params.id, {
      attributes: { exclude: ["password"] },
    });
    return res.json({
      status: "ok",
      data,
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
