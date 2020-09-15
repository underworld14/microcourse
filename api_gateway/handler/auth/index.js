const apiAdapter = require("../apiAdapter");
const catchAsync = require("../catchAsync");
const jwt = require("../../utils/jwt");

const api = apiAdapter(process.env.URL_USER_SERVICE);

const generateCredentials = async (userId, role) => {
  const access_token = await jwt.generateToken({
    id: userId,
    role,
  });
  const { data } = await api.post("/refresh-token/save", {
    userId: userId,
  });

  return {
    access_token,
    refresh_token: data.data.token,
  };
};

exports.register = catchAsync(async (req, res) => {
  let { data } = await api.post("/register", req.body);
  const credentials = await generateCredentials(data.data.id, data.data.role);

  data.credentials = credentials;
  delete data.data.password;

  res.json(data);
});

exports.login = catchAsync(async (req, res) => {
  let { data } = await api.post("/login", req.body);
  const credentials = await generateCredentials(data.data.id, data.data.role);

  data.credentials = credentials;
  delete data.data.password;

  res.json(data);
});

exports.logout = catchAsync(async (req, res) => {
  let { data } = await api.post("/logout", req.body);

  res.json(data);
});

exports.refresh_token = catchAsync(async (req, res) => {
  let { data } = await api.post("/refresh-token", req.body);
  const access_token = await jwt.generateToken({
    id: data.data.id,
    role: data.data.role,
  });
  data.credentials.access_token = access_token;
  delete data.data.password;

  res.json(data);
});
