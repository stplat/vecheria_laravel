const path = require('path');
const merge = require('webpack-merge');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const pug = require('./webpack_modules/pug');
const extractCSS = require('./webpack_modules/css.extract');
const css = require('./webpack_modules/css');
const webpack = require('webpack');
const sourceMap = require('./webpack_modules/sourceMap');
const lintJS = require('./webpack_modules/js.lint');
const lintCSS = require('./webpack_modules/sass.lint');
const images = require('./webpack_modules/images');
const babel = require('./webpack_modules/babel');
const favicon = require('./webpack_modules/favicon');
const uglify = require('./webpack_modules/uglify');

/* Оптимизация изображений
const ImageminPlugin = require("imagemin-webpack");
const imageminGifsicle = require("imagemin-gifsicle");
const imageminJpegtran = require("imagemin-jpegtran");
const imageminOptipng = require("imagemin-optipng");
const imageminSvgo = require("imagemin-svgo");*/


const PATHS = {
  source: path.join(__dirname, 'source'),
  build: path.join(__dirname, '../../../public'),
};

const config = merge([
  {
    entry: {
      'main': PATHS.source + '/main.js',
    },
    output: {
      path: PATHS.build,
      filename: 'js/[name].js',
    },
    watch: true,
    plugins: [
      new webpack.ProvidePlugin({
        $: 'jquery',
        jQuery: 'jquery',
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/layout.blade.php',
        template: PATHS.source + '/views/_layout.pug',
        inject: false,
        templateParameters: {
          'cssPath': '/css/style.css',
          'jsPath': '/js/main.js'
        }
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/index.blade.php',
        template: PATHS.source + '/views/index.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/catalog.blade.php',
        template: PATHS.source + '/views/catalog.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/product.blade.php',
        template: PATHS.source + '/views/product.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/shipping.blade.php',
        template: PATHS.source + '/views/shipping.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/payment.blade.php',
        template: PATHS.source + '/views/payment.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/contacts.blade.php',
        template: PATHS.source + '/views/contacts.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/cart.blade.php',
        template: PATHS.source + '/views/cart.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/errors/404.blade.php',
        template: PATHS.source + '/views/404.pug',
        inject: false,
      }),
      new HtmlWebpackPlugin({
        filename: '../resources/views/search.blade.php',
        template: PATHS.source + '/views/search.pug',
        inject: false,
      }),
    ],
  },
  images(),
  pug(),
  babel(),
]);

module.exports = function (env, argv) {
  if (argv.mode === 'production') {
    config.devtool = false;
    config.watch = false;
    return merge([
      config,
      extractCSS(),
      favicon(),
      uglify(),
    ]);
  }
  if (argv.mode === 'development') {
    return merge([
      config,
      lintJS({paths: PATHS.sources}),
      lintCSS(),
      extractCSS(),
      sourceMap(),
    ]);
  }
};
