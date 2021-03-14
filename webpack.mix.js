const mix = require('laravel-mix');
const { min } = require('lodash');

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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.js('resources/js/dataTable.js', 'public/js')
    .js('resources/js/dataTablesPage.js', 'public/js')
    .js('resources/js/previewImage.js', 'public/js')
    .js('resources/js/menu.js', 'public/js');
mix.postCss('resources/css/dataTable.css', 'public/css');
mix.postCss('resources/css/all.css', 'public/css');