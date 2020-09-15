module.exports = (err, req, res) => {
  const code = err.statusCode || 500;
  const status = err.status || "error";

  if (err.code === "ECONNREFUSED") {
    return res
      .status(500)
      .json({ status: "error", message: "service unavailable" });
  }

  console.log(err);

  if (err.name === "UnauthorizedError") {
    return res.status(401).json({
      status: status,
      message: "Unauthorized token or invalid !",
    });
  }

  // axios error code if exists
  if (err.response) {
    return res.status(err.response.status).json({
      ...err.response.data,
      stack: err.stack,
    });
  }

  return res.status(code).json({
    status: status,
    message: err.message,
    stack: err.stack,
  });
};
