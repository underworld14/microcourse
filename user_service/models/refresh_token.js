"use strict";
const { Model } = require("sequelize");
module.exports = (sequelize, DataTypes) => {
  class refresh_token extends Model {
    /**
     * Helper method for defining associations.
     * This method is not a part of Sequelize lifecycle.
     * The `models/index` file will call this method automatically.
     */
    static associate(models) {
      // define association here
      models.refresh_token.belongsTo(models.user);
    }
  }
  refresh_token.init(
    {
      userId: DataTypes.INTEGER,
      token: DataTypes.STRING,
    },
    {
      sequelize,
      modelName: "refresh_token",
    }
  );
  return refresh_token;
};
