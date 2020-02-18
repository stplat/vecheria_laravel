const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
module.exports = function () {
  return {
    module: {
      rules: [
        {
          test: /\.js(\?.*)?$/i,
        }
      ],
    },
    plugins: [
      new UglifyJsPlugin(),
    ],
  };
};