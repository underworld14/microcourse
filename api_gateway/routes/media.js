const express = require("express");
const router = express.Router();

const mediaHandler = require("../handler/media");

router.get("/", mediaHandler.getAllMedia);
router.post("/upload", mediaHandler.uploadMedia);
router.delete("/delete/:id", mediaHandler.deleteMedia);

module.exports = router;
