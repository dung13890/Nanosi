const { mix } = require('laravel-mix');
const webpack = require('webpack');

var del = require('del');
var path = require('path');
var plugins = require('./npm/plugins');
var config = require('./npm/config');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
del(config.plugins.bower.out);
del(config.plugins.scripts.out);
del(config.plugins.img.out);
del(config.plugins.sass.out);
del(config.plugins.styles.out);

mix.copy(config.plugins.img.in, config.plugins.img.out, false);

plugins.bower.map(function (bower) {
  mix.copy(path.join(config.plugins.bower.in, bower.in), path.join(config.plugins.bower.out, bower.out), false);
});

mix.scripts([
  path.join(config.plugins.scripts.in, 'laroute.js'),
  path.join(config.plugins.scripts.in, '../bower/sweetalert/dist/sweetalert.min.js'),
  path.join(config.plugins.scripts.in, '../bower/toastr/toastr.min.js'),
  path.join(config.plugins.scripts.in, 'backend/app.js'),
], path.join(config.plugins.scripts.out, 'backend/app.js'));

mix.styles([
  path.join(config.plugins.styles.in, 'sweetalert/dist/sweetalert.css'),
  path.join(config.plugins.styles.in, 'toastr/toastr.min.css'),
], path.join(config.plugins.styles.out, 'backend/plugins.css'));

plugins.sass.map(function (sass) {
  mix.sass(path.join(config.plugins.sass.in, sass.in), path.join(config.plugins.sass.out, sass.out))
});

if (mix.config.inProduction) {
  mix.version();
}
