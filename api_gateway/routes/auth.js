const express = require("express");
const router = express.Router();

const auth = require("../handler/auth");

/* GET home page. */
router.post("/register", auth.register);
router.post("/login", auth.login);
router.post("/logout", auth.logout);
router.post("/refresh-token", auth.refresh_token);

module.exports = router;
