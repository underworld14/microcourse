const express = require("express");
const router = express.Router();

const registerHandler = require("../handler/register");
const loginHandler = require("../handler/login");
const logoutHandler = require("../handler/logout");
const saveTokenHandler = require("../handler/saveToken");
const findTokenHandler = require("../handler/findToken");
const updateUserHandler = require("../handler/updateUser");
const userHandler = require("../handler/getUser");
const usersHandler = require("../handler/getUsers");

/* GET home page. */
router.get("/", (req, res) => {
  res.send("user service !");
});

router.post("/register", registerHandler);
router.post("/login", loginHandler);
router.post("/logout", logoutHandler);
router.post("/refresh-token", findTokenHandler);
router.post("/refresh-token/save", saveTokenHandler);
router.get("/user", usersHandler);
router.get("/user/:id", userHandler);
router.patch("/user/:id", updateUserHandler);

module.exports = router;
