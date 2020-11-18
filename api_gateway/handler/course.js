const catchAsync = require("./catchAsync");
const apiAdapter = require("./apiAdapter");

const courseApi = apiAdapter(process.env.URL_COURSE_SERVICE);

exports.index = catchAsync(async (req, res) => {
  const courses = await courseApi.get("/api/course", { params: req.query });
  return res.status(courses.status).json(courses.data);
});

exports.create = catchAsync(async (req, res) => {
  const course = await courseApi.post("/api/course", req.body);
  return res.status(course.status).json(course.data);
});

exports.show = catchAsync(async (req, res) => {
  const course = await courseApi.get(`/api/course/${req.params.id}`);
  return res.status(course.status).json(course.data);
});

exports.update = catchAsync(async (req, res) => {
  const course = await courseApi.patch(`/api/course/${req.params.id}`);
  return res.status(course.status).json(course.data);
});

exports.destroy = catchAsync(async (req, res) => {
  const course = await courseApi.delete(`/api/course/${req.params.id}`);
  return res.status(course.status).json(course.data);
});
