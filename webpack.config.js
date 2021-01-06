const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
  mode: 'development',
  entry: {
    style: path.resolve(__dirname, 'frontend/scss/style.scss'),
    app: path.resolve(__dirname, 'frontend/js/app.js')
  },
  output: {
    filename: '[name].js',
    path: path.resolve(__dirname, 'frontend/web/build'),
  },
  watch: true,
  watchOptions: {
    ignored: ['vendor/**', 'frontend/web/**', 'node_modules/**']
  },
  devtool: "source-map",
  plugins: [new MiniCssExtractPlugin()],
  module: {
    rules: [
      {
        test: /\.s[ac]ss$/i,
        use: [
          MiniCssExtractPlugin.loader,
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ],
      },
    ],
  },
};