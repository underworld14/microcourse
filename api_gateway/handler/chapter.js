const catchAsync = require("./catchAsync");
const apiAdapter = require("./apiAdapter");

const courseApi = apiAdapter(process.env.URL_COURSE_SERVICE);

exports.create = catchAsync(async (req, res) => {
  const chapter = await courseApi.post("/api/chapter", req.body);
  return res.status(chapter.status).json(chapter.data);
});

exports.update = catchAsync(async (req, res) => {
  const chapter = await courseApi.patch(
    `/api/chapter/${req.params.id}`,
    req.body
  );
  return res.status(chapter.status).json(chapter.data);
});

exports.destroy = catchAsync(async (req, res) => {
  const chapter = await courseApi.patch(`/api/chapter/${req.params.id}`);
  return res.status(chapter.status).json(chapter.data);
});
