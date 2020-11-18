const express = require("express");
const router = express.Router();

const chapterHandler = require("../handler/chapter");

router.post("/", chapterHandler.create);
router.patch("/:id", chapterHandler.update);
router.delete("/:id", chapterHandler.destroy);

module.exports = router;
