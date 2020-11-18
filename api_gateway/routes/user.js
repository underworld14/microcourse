const express = require("express");
const router = express.Router();

const user = require("../handler/user");

router.get("/profile", user.getProfile);
router.patch("/update", user.updateUser);

module.exports = router;
