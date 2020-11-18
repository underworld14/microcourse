const catchAsync = require("./catchAsync");
const apiAdapter = require("./apiAdapter");

const courseApi = apiAdapter(process.env.URL_COURSE_SERVICE);

exports.create = catchAsync(async (req, res) => {
  const lesson = await courseApi.post("/api/lesson", req.body);
  return res.status(lesson.status).json(lesson.data);
});

exports.update = catchAsync(async (req, res) => {
  const lesson = await courseApi.patch(
    `/api/lesson/${req.params.id}`,
    req.body
  );
  return res.status(lesson.status).json(lesson.data);
});

exports.destroy = catchAsync(async (req, res) => {
  const lesson = await courseApi.delete(`/api/lesson/${req.params.id}`);
  return res.status(lesson.status).json(lesson.data);
});
