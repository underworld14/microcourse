const express = require("express");
const router = express.Router();

const authJwt = require("../middleware/authJwt");
const courseHandler = require("../handler/course");

router.get("/", courseHandler.index);
router.post("/", authJwt, courseHandler.create);
router.get("/:id", courseHandler.show);
router.patch("/:id", authJwt, courseHandler.update);
router.delete("/:id", authJwt, courseHandler.destroy);

module.exports = router;
