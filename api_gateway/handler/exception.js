class HttpException extends Error {
  statusCode;
  status;
  isOperational;
  detail;

  constructor(message, statusCode, detail) {
    super(message);

    this.statusCode = statusCode || 500;
    this.status = "error";
    this.detail = detail;

    Error.captureStackTrace(this, this.constructor);
  }
}

module.exports = HttpException;
