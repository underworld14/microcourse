const express = require("express");
const path = require("path");
const cookieParser = require("cookie-parser");
const logger = require("morgan");

const errorHandler = require("./middleware/error");
const Exception = require("./handler/exception");
const indexRouter = require("./routes/index");
const mediaRouter = require("./routes/media");
const authRouter = require("./routes/auth");
const userRouter = require("./routes/user");
// const coursesRouter = require("./routes/courses");
// const paymentRouter = require("./routes/payment");

const app = express();

app.use(logger("dev"));
app.use(express.json({ limit: "50mb" }));
app.use(express.urlencoded({ extended: false, limit: "50mb" }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, "public")));

app.use("/", indexRouter);
app.use("/media", mediaRouter);
app.use("/auth", authRouter);
app.use("/user", userRouter);

// app.use("/courses", coursesRouter);
// app.use("/paymentRouter", paymentRouter);

app.all("*", (req, res, next) => {
  return next(new Exception("Page not found", 404));
});
app.use(errorHandler);

module.exports = app;
