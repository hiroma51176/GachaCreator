const mix = require('laravel-mix');

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
    .js('resources/js/result-animation.js', 'public/js')
    .js('resources/js/list-delete-check.js', 'public/js')
    .js('resources/js/data-validation/simulation.js', 'public/js/data-validation')
    .js('resources/js/data-validation/gacha-create.js', 'public/js/data-validation')
    .js('resources/js/data-validation/gacha-edit.js', 'public/js/data-validation')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/common.scss', 'public/css')
    .sass('resources/sass/top.scss', 'public/css')
    .sass('resources/sass/result.scss', 'public/css')
    .sass('resources/sass/terms.scss', 'public/css');
    
