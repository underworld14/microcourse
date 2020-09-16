module.exports = (...roles) => {
  return (req, res, next) => {
    if (!roles.includes(req.user.role)) {
      return res.status(401).json({
        status: "error",
        message: "you are not allowed to perform this actions !",
      });
    }

    next();
  };
};
