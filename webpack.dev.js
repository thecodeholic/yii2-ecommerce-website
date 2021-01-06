const { merge } = require('webpack-merge');
const common = require('./webpack.common.js');

module.exports = merge(common, {
  mode: 'development',
  watch: true,
  watchOptions: {
    ignored: ['vendor/**', 'frontend/web/**', 'node_modules/**']
  },
  devtool: "source-map",
});