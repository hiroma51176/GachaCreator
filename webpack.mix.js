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
    .js('resources/js/animation/result.js', 'public/js/animation')
    .js('resources/js/data-validation/list-delete-check.js', 'public/js/data-validation')
    .js('resources/js/data-validation/pulldown-control.js', 'public/js/data-validation')
    .js('resources/js/data-validation/submit-gacha-create.js', 'public/js/data-validation')
    .js('resources/js/data-validation/submit-gacha-edit.js', 'public/js/data-validation')
    .js('resources/js/data-validation/submit-prize.js', 'public/js/data-validation')
    .js('resources/js/data-validation/submit-simulation.js', 'public/js/data-validation')
    .js('resources/js/message/input-name.js', 'public/js/message')
    .js('resources/js/message/input-price.js', 'public/js/message')
    .js('resources/js/message/input-rate.js', 'public/js/message')
    .js('resources/js/message/input-simulation.js', 'public/js/message')
    .js('resources/js/message/select-image.js', 'public/js/message')
    // .js('resources/js/message/simulation.js', 'public/js/message')
    // .js('resources/js/data-validation/gacha-create.js', 'public/js/data-validation')
    // .js('resources/js/data-validation/gacha-edit.js', 'public/js/data-validation')
    // .js('resources/js/data-validation/prize-create.js', 'public/js/data-validation')
    // .js('resources/js/data-validation/prize-edit.js', 'public/js/data-validation')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/common.scss', 'public/css')
    .sass('resources/sass/top.scss', 'public/css')
    .sass('resources/sass/result.scss', 'public/css')
    .sass('resources/sass/terms.scss', 'public/css');
    
