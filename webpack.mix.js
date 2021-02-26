const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/login.js','public/js')
    .sass('resources/sass/login.scss','public/css')
    .js('resources/js/backend.js','public/js')
    .sass('resources/sass/backend.scss','public/css').sourceMaps();

mix.sass('resources/sass/mdiIcons.scss','plugins/css');
