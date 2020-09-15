const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    await db.user.update(req.body, { where: { id: req.params.id } });
    return res.json({
      status: "ok",
      data: {
        id: req.params.id,
      },
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
