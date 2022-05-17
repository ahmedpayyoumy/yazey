const path = require("path");
const webpack = require("webpack");
const dotenv = require("dotenv");
dotenv.config();

module.exports = function (env) {
  const isProduction = env === "production";
  const plugins = [new webpack.IgnorePlugin(/^\.\/locale$/, /moment$/)];

  return {
    plugins,
    mode: isProduction ? "production" : "development",
    devtool: "source-map",
    resolve: {
      extensions: [".js", ".jsx"],
    },
    module: {
      rules: [
        {
          test: /\.js(x?)$/,
          exclude: /node_modules/,
          use: [{ loader: "babel-loader" }, { loader: "eslint-loader" }],
        },
        {
          enforce: "pre",
          test: /\.js$/,
          exclude: /node_modules/,
          loader: "source-map-loader",
        },
        {
          test: /\.css$/,
          use: [
            {
              loader: "css-loader",
              options: {
                sourceMap: true,
              },
            },
          ],
        },
      ],
    },

    entry: {
      chat: path.join(__dirname, "client", "ChatApp.jsx"),
      chat_private: path.join(__dirname, "client", "ChatPrivateReplyApp.jsx"),
      chat_template: path.join(__dirname, "client", "ChatTemplateApp.jsx"),
      chat_button_block: path.join(__dirname, "client", "ChatButtonBlockApp.jsx"),
      portal: path.join(__dirname, "client", "Portal.jsx"),
    },
    output: {
      filename: path.join("js", "[name].js"),
      path: path.join(__dirname, "public"),
      publicPath: "/",
      chunkFilename: path.join("js", "chunk_[id].js"),
    },
  };
};
