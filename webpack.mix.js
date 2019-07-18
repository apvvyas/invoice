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
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/bootstrap.js', 'public/js');
    
mix.copyDirectory('resources/assets', 'public');
mix.copyDirectory('resources/frontend', 'public');

mix.copyDirectory('resources/images','public');

mix.js('resources/js/pages/invoice/add.js','public/js/pages/invoice-add.js');
mix.js('resources/js/pages/invoice/index.js','public/js/pages/invoice-list.js');


mix.js('resources/js/pages/users/add.js','public/js/pages/user-add.js');
mix.js('resources/js/pages/users/edit.js','public/js/pages/user-edit.js');
mix.js('resources/js/pages/users/index.js','public/js/pages/user-list.js');


mix.js('resources/js/pages/recipients/add.js','public/js/pages/recipient-add.js');
mix.js('resources/js/pages/recipients/edit.js','public/js/pages/recipient-edit.js');
mix.js('resources/js/pages/recipients/index.js','public/js/pages/recipient-list.js');


mix.js('resources/js/pages/products/add.js','public/js/pages/product-add.js');
mix.js('resources/js/pages/products/edit.js','public/js/pages/product-edit.js');
mix.js('resources/js/pages/products/index.js','public/js/pages/product-list.js');


mix.js('resources/js/pages/taxes/index.js','public/js/pages/tax-list.js');


mix.js('resources/js/pages/dashboard.js','public/js/pages/dashboard.js');