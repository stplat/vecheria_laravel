const FaviconsWebpackPlugin = require('favicons-webpack-plugin');
module.exports = function() {
  return {
    plugins: [
      new FaviconsWebpackPlugin({
        logo: './source/components/_defaults/favicon.png',
        icons: {
          appleStartup: false,
        }
      }),
    ],
  };
};