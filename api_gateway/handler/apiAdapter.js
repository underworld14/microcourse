const axios = require("axios").default;

module.exports = (baseUrl) => {
  return axios.create({
    baseURL: baseUrl,
    timeout: 6000,
    headers: {
      Accept: "application/json",
    },
  });
};
