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

mix.sass('resources/sass/app.scss', 'public/css');

mix.js([
    'resources/js/app.js',
    'node_modules/datatables.net/js/jquery.dataTables.js',
    'node_modules/bootstrap/dist/js/bootstrap.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
    'node_modules/toastr/toastr.js',
    'node_modules/jquery/dist/jquery.min.js',
], 'public/js/app_admin.js')
    .styles([
        'public/css/app.css',
        'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
        'resources/asset/admin/css/admin.css',
    ], 'public/css/admin_style.css')
    .copyDirectory('node_modules/ckeditor/', 'public/ckeditor/');

mix.js([
    'resources/js/sweetalert.min.js'
], 'public/js/');
/**
 *  Mix Admin
 **/
// mix.styles([
//     'public/css/app.css',
//     'resources/asset/admin/css/admin.css',
//     'resources/asset/admin/css/custom.css',
// ], 'public/css/admin_style.css');

/**
 *  Mix Client
 **/
mix.styles([
    'resources/asset/client/css/bootstrap.min.css',
    'resources/asset/client/css/font-awesome.css',
    'resources/asset/client/css/simple-line-icons.css',
    'resources/asset/client/css/owl.carousel.css',
    'resources/asset/client/css/owl.theme.css',
    'resources/asset/client/css/jquery.bxslider.css',
    'resources/asset/client/css/jquery.mobile-menu.css',
    'resources/asset/client/css/style.css',
    'resources/asset/client/css/revslider.css',
    'resources/asset/client/css/thm_menu.css',
    'resources/asset/client/css/internal.css',
    'resources/asset/client/css/custom.css',
    'resources/asset/client/css/toastr.css',
], 'public/css/app_client.css')
    .js([
        'node_modules/jquery/dist/jquery.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        'resources/asset/client/js/revslider.js',
        'node_modules/common/common.min.js',
        'node_modules/owl.carousel/dist/owl.carousel.min.js',
        'resources/asset/client/js/jquery.mobile-menu.min.js',
        'resources/asset/client/js/countdown.js',
        'resources/asset/client/js/js_cloud-zoom.js',
        'node_modules/toastr/toastr.js',
    ], 'public/js/app_client.js');

mix.copyDirectory('node_modules/simple-line-icons/fonts/', 'public/fonts/');
mix.copyDirectory('node_modules/font-awesome/fonts/', 'public/fonts/');
mix.copyDirectory('resources/asset/image/', 'public/images/');
mix.copyDirectory('resources/asset/client/js/themessoft/', 'public/asset/client/js/themessoft/');
