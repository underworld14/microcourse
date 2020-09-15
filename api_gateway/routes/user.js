const express = require("express");
const router = express.Router();

const authJwt = require("../middleware/authJwt");

const user = require("../handler/user");

router.get("/profile", authJwt, user.getProfile);
router.patch("/update", authJwt, user.updateUser);

module.exports = router;
