const { mix } = require('laravel-mix');

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

// CSS Files
mix.styles([
    "node_modules/admin-lte/bootstrap/css/bootstrap.css",
    "node_modules/admin-lte/dist/css/alt/AdminLTE-select2.css",
    "node_modules/admin-lte/dist/css/skins/_all-skins.css",
    "node_modules/admin-lte/dist/css/AdminLTE.css",
    "node_modules/admin-lte/plugins/iCheck/square/_all.css",
    "node_modules/font-awesome/css/font-awesome.css",
    "resources/assets/css/custom.css"
], "public/css/app.css");

// img icheck
mix.copy("node_modules/admin-lte/plugins/iCheck/square/blue.png", "public/css");

// JS Files
mix.scripts([
    "node_modules/admin-lte/plugins/jQuery/jquery-2.2.3.min.js",
    "node_modules/admin-lte/bootstrap/js/bootstrap.js",
    "node_modules/admin-lte/dist/js/app.js",
    "node_modules/admin-lte/plugins/iCheck/icheck.js",
    "resources/assets/js/custom.js"
], "public/js/app.js");

// Fonts
mix.copy("node_modules/admin-lte/bootstrap/fonts", "public/fonts");
mix.copy("node_modules/font-awesome/fonts", "public/fonts");

// Img
mix.copy("node_modules/admin-lte/dist/img/", "public/img/");