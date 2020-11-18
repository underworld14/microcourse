const catchAsync = require("../catchAsync");
const apiAdapter = require("../apiAdapter");

const courseApi = apiAdapter(process.env.URL_COURSE_SERVICE);

exports.index = catchAsync(async (req, res) => {
  const mentors = await courseApi.get("/api/mentor", { params: req.query });
  console.log(mentors);
  return res.status(mentors.status).json(mentors.data);
});

exports.show = catchAsync(async (req, res) => {
  const mentor = await courseApi.get(`/api/mentor/${req.params.id}`);
  return res.status(mentor.status).json(mentor.data);
});

exports.create = catchAsync(async (req, res) => {
  const mentor = await courseApi.post(`/api/mentor`, req.body);
  return res.status(mentor.status).json(mentor.data);
});

exports.update = catchAsync(async (req, res) => {
  const mentor = await courseApi.patch(
    `/api/mentor/${req.params.id}`,
    req.body
  );
  return res.status(mentor.status).json(mentor.data);
});

exports.destroy = catchAsync(async (req, res) => {
  const mentor = await courseApi.delete(`/api/mentor/${req.params.id}`);
  return res.status(mentor.status).json(mentor.data);
});
