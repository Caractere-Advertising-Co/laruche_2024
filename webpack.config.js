const path = require("path");

module.exports = {
  watch: true,
  entry: {
    main: "./src/index.js",
    style: "./src/style.js",
  },
  mode: "production",
  output: {
    filename: "[name].bundle.js",
    path: path.resolve(__dirname, "dist"),
  },
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: ["style-loader", "css-loader", "sass-loader"],
      },
    ],
  },
};
