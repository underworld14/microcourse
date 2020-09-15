module.exports = (res, error) => {
  return res.status(400).json({
    status: "error",
    message: error.message,
  });
};
