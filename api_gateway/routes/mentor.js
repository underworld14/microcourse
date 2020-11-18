const express = require("express");
const router = express.Router();

const mentorHandler = require("../handler/mentor");

router.get("/", mentorHandler.index);
router.post("/", mentorHandler.create);
router.get("/:id", mentorHandler.show);
router.patch("/:id", mentorHandler.update);
router.delete("/:id", mentorHandler.destroy);

module.exports = router;
