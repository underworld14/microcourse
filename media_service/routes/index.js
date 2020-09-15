const fs = require("fs");
const express = require("express");
const router = express.Router();
const isBase64 = require("is-base64");
const base64Img = require("base64-img");

const Media = require("../models").media;

router.get("/", async (req, res) => {
  const medias = await Media.findAll();
  const data = medias.map((item) => {
    item.image = `${req.get("host")}/images/${item.image}`;
    return item;
  });

  return res.json({
    status: "ok",
    data,
  });
});

router.post("/upload-img", (req, res) => {
  const image = req.body.image;
  if (!isBase64(image, { mimeRequired: true })) {
    return res.status(400).json({
      status: "error",
      message: "Invalid base64 format",
    });
  }

  base64Img.img(image, "./public/images", Date.now(), async (err, filepath) => {
    if (err) {
      return res.status(400).json({ status: "error", message: err.message });
    }

    filepath = filepath.split("/").pop();

    const media = await Media.create({ image: filepath });

    return res.status(200).json({
      status: "ok",
      data: {
        id: media.id,
        image: `${req.get("host")}/images/${media.image}`,
      },
    });
  });
});

router.delete("/delete/:id", async (req, res) => {
  const media = await Media.findByPk(req.params.id);
  if (!media) return res.status(404).json({ status: "notfound" });

  fs.unlink(`./public/images/${media.image}`, async (err) => {
    if (err) {
      return res.status(400).json({ status: "error", message: err.message });
    }

    await media.destroy();

    return res.json({
      status: "ok",
      message: "successfull deleted image",
    });
  });
});

module.exports = router;
