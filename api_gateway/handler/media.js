const apiAdapter = require("./apiAdapter");
const catchAsync = require("./catchAsync");

const api = apiAdapter(process.env.URL_MEDIA_SERVICE);

exports.getAllMedia = catchAsync(async (req, res) => {
  const { data } = await api.get("/");
  res.json(data);
});

exports.uploadMedia = catchAsync(async (req, res) => {
  const { data } = await api.post("/upload-img", req.body);
  res.json(data);
});

exports.deleteMedia = catchAsync(async (req, res) => {
  const { data } = await api.delete(`/delete/${req.params.id}`);
  res.json(data);
});
