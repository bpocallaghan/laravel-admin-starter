const {mix} = require('laravel-mix');

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

var COMPILE = 'all';
var public = 'public';
var pathBase = 'resources/assets';

// mix.copyDirectory('assets/img', 'public/img');

if (COMPILE == 'all') {
    // copy all the fonts
    mix.copy(pathBase + '/fonts', public + '/fonts');

    // copy all the sound
    mix.copy(pathBase + '/sounds', public + '/sounds');

    // copy all the images
    mix.copy(pathBase + '/images', public + '/images');
}

if (COMPILE == 'admin' || COMPILE == 'all') {
    // admin style sheets
    var path = pathBase + '/admin/';

    // copy all the fonts
    mix.copy(path + 'fonts', public + '/fonts');

    // copy all the images
    mix.copy(path + 'images', public + '/images/admin');

    mix.styles([
        path + 'bootstrap.css',
        path + 'font-awesome.css',
        path + 'ionicons.css',

        // plugins
        path + 'plugins/select2.css',
        path + 'plugins/lightbox.css',
        path + 'plugins/dropzone.css',
        path + 'plugins/summernote.css',
        path + 'plugins/daterangepicker.css',
        path + 'plugins/pace-theme-flash.css',
        path + 'plugins/bootstrap-datetimepicker.css',
        path + 'plugins/datatables/dataTables.bootstrap.css',
        path + 'plugins/datatables/responsive.bootstrap.css',

        // admin
        path + 'admin-lte.css',
        path + 'skins/skin-blue.css',

        // titan
        path + 'titan/titan.css',
        path + 'titan/charts.css',
        path + 'titan/superbox.css',
        path + 'titan/nestable.css',
        path + 'titan/datatables.css',
        path + 'titan/checkboxes.css',

        path + 'titan/notify.css',
    ], public + '/css/admin/all.css');

    // admin javascripts
    mix.scripts([
        // jquery
        path + 'jquery-2.2.1.js',

        // bootstrap
        path + 'bootstrap.js',

        // plugins
        path + 'plugins/pace.js',
        path + 'plugins/chart.js',
        path + 'plugins/select2.js',
        path + 'plugins/dropzone.js',
        path + 'plugins/lightbox.js',
        path + 'plugins/fastclick.js',
        path + 'plugins/summernote.js',
        path + 'plugins/jquery.nestable.js',

        // date picker
        path + 'plugins/moment.js',
        path + 'plugins/daterangepicker.js',
        path + 'plugins/bootstrap-datetimepicker.js',

        // datatables | 1.10.11
        // https://datatables.net/extensions/responsive/classes
        path + 'plugins/datatables/jquery.dataTables.js',
        path + 'plugins/datatables/dataTables.bootstrap.js',
        path + 'plugins/datatables/dataTables.responsive.js',

        // titan
        path + 'titan/titan.js',
        path + 'titan/datatables.js',
        path + 'titan/google_maps.js',

        path + 'titan/notify.js',

        // admin
        path + 'admin-lte.js',
        path + 'admin.js',

    ], public + '/js/admin/all.js');
}

if (COMPILE == 'website' || COMPILE == 'all') {

    // website stylesheets
    var path = pathBase + '/website/';

    // copy all the fonts
    // mix.copy(path + 'fonts', public + '/fonts');

    // copy all the images
    // mix.copy(path + 'images', public + '/images');

    mix.css([
        path + 'bootstrap.css',
        path + 'website.css',
    ], public + '/css/all.css');

    // admin javascripts
    mix.scripts([
        // jquery
        path + 'jquery-2.2.1.js',
        // bootstrap
        path + 'bootstrap.js',
    ], public + '/js/all.js');
}