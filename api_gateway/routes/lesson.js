const express = require("express");
const router = express.Router();

const lessonHandler = require("../handler/lesson");

router.post("/", lessonHandler.create);
router.patch("/:id", lessonHandler.update);
router.delete("/:id", lessonHandler.destroy);

module.exports = router;
