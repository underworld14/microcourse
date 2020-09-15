const apiAdapter = require("../apiAdapter");
const catchAsync = require("../catchAsync");

const api = apiAdapter(process.env.URL_USER_SERVICE);

exports.updateUser = catchAsync(async (req, res) => {
  delete req.body.password;
  const { data } = await api.patch(`/user/${req.user.id}`, req.body);

  res.json(data);
});

exports.getProfile = catchAsync(async (req, res) => {
  const { data } = await api.get(`/user/${req.user.id}`);

  res.json(data);
});
