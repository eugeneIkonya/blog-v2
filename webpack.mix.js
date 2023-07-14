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


// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css');


mix.styles([
    'public/css/base.css',
    'public/css/main.css',
    'public/css/vendor.css',
],'public/css/style.css');

mix.js([
    'public/js/main.js',
    'public/js/modernizr.js',
    'public/js/plugins.js',
],'public/js/scripts.js');
mix.js([
    'public/js/create.js',
    'public/js/step.js',
],'public/js/admin.js');