const errorResponse = require("./errresponse");
const db = require("../models");

module.exports = async (req, res) => {
  try {
    let sqlOptions = {
      attributes: { exclude: ["password"] },
    };

    if (req.query.id) {
      const userIds = req.query.id.split(",");
      sqlOptions.where = {
        id: userIds,
      };
    }
    const data = await db.user.findAll(sqlOptions);
    return res.json({
      status: "ok",
      data,
    });
  } catch (error) {
    errorResponse(res, error);
  }
};
