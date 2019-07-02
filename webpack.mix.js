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
    .sass('resources/sass/app.scss', 'public/css');
mix.copyDirectory('resources/assets', 'public');

mix.js('resources/js/pages/invoice/add.js','public/js/pages/invoice-add.js');
mix.js('resources/js/pages/invoice/index.js','public/js/pages/invoice-list.js');


mix.js('resources/js/pages/users/add.js','public/js/pages/user-add.js');
mix.js('resources/js/pages/users/edit.js','public/js/pages/user-edit.js');
mix.js('resources/js/pages/users/index.js','public/js/pages/user-list.js');


mix.js('resources/js/pages/recipients/add.js','public/js/pages/recipient-add.js');
mix.js('resources/js/pages/recipients/edit.js','public/js/pages/recipient-edit.js');
mix.js('resources/js/pages/recipients/index.js','public/js/pages/recipient-list.js');