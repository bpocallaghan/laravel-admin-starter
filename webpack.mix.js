let mix = require('laravel-mix');

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

if (COMPILE == 'all') {
    // copy all the fonts
    mix.copy(pathBase + '/fonts', public + '/fonts');

    // copy all the sound
    // mix.copy(pathBase + '/sounds', public + '/sounds');

    // copy all the images
    mix.copy(pathBase + '/images', public + '/images');
}

// website assets
if (COMPILE == 'website' || COMPILE == 'all') {
    var path = pathBase + '/';
    var pathCSS = path + '/css/';
    var pathJS = path + '/js/';

    mix.sass('resources/assets/sass/vendor.scss', pathCSS )
        .setPublicPath('resources');

    mix.styles([
        pathCSS + 'vendor.css',
        pathCSS + 'vendor/animate.css',
        pathCSS + 'vendor/fancybox.css',
        pathCSS + 'vendor/font-awesome.css',
        pathCSS + 'vendor/jquery.fancybox.css',

        pathCSS + 'app/faq.css',
        pathCSS + 'app/colors.css',
        pathCSS + 'app/pricing.css',
        pathCSS + 'app/utilities.css',
        pathCSS + 'app/testimonials.css',

        pathCSS + 'website.css',
        pathCSS + 'overrides.css',
    ], public + '/css/website.css');

    // website javascripts
    mix.scripts([
        pathJS + 'vendor/jquery-3.2.1.js',
        pathJS + 'vendor/popper.js', // bootstrap dependency
        pathJS + 'vendor/bootstrap.js',

        pathJS + 'vendor/jquery.fancybox.min.js',
        pathJS + 'vendor/lazysizes.min.js',
        //pathJS + 'vendor/owl.carousel.min.js',

        pathJS + 'titan/alerts.js',
        pathJS + 'titan/buttons.js',
        pathJS + 'titan/forms.js',
        pathJS + 'titan/google_maps.js',
        pathJS + 'titan/social_media.js',
        pathJS + 'titan/pagination.js',
        pathJS + 'titan/utils.js',

        pathJS + 'website.js',
    ], public + '/js/website.js');
}

// admin assets
if (COMPILE == 'admin' || COMPILE == 'all') {
    var path = pathBase + '/admin/';

    // copy all the fonts
    mix.copy(path + 'fonts', public + '/fonts');

    // copy all the sounds
    mix.copy(path + 'sounds', public + '/sounds');

    // copy all the images
    mix.copy(path + 'images', public + '/images/admin');

    var pathCSS = path + '/css/';
    mix.styles([
        pathCSS + 'vendor/bootstrap.css',
        pathCSS + 'vendor/font-awesome.css',
        pathCSS + 'vendor/ionicons.css',

        // plugins
        pathCSS + 'vendor/select2.css',
        pathCSS + 'vendor/lightbox.css',
        pathCSS + 'vendor/dropzone.css',
        pathCSS + 'vendor/summernote.css',
        pathCSS + 'vendor/daterangepicker.css',
        pathCSS + 'vendor/pace-theme-flash.css',
        pathCSS + 'vendor/bootstrap-datetimepicker.css',
        pathCSS + 'vendor/datatables.bootstrap.css',
        pathCSS + 'vendor/responsive.bootstrap.css',
        pathCSS + 'vendor/cropper.css',

        // admin
        pathCSS + 'admin-lte.css',
        pathCSS + 'skins/skin-blue.css',
        // pathCSS + 'skins/skin-blue-light.css',
        // pathCSS + 'skins/skin-black.css',
        // pathCSS + 'skins/skin-black-light.css',
        // pathCSS + 'skins/skin-green.css',
        // pathCSS + 'skins/skin-green-light.css',
        // pathCSS + 'skins/skin-purple.css',
        // pathCSS + 'skins/skin-purple-light.css',
        // pathCSS + 'skins/skin-red.css',
        // pathCSS + 'skins/skin-red-light.css',
        // pathCSS + 'skins/skin-yellow.css',
        // pathCSS + 'skins/skin-yellow-light.css',

        // // titan
        pathCSS + 'titan/titan.css',
        pathCSS + 'titan/charts.css',
        pathCSS + 'titan/superbox.css',
        pathCSS + 'titan/nestable.css',
        pathCSS + 'titan/datatables.css',
        pathCSS + 'titan/checkboxes.css',
        pathCSS + 'titan/notify.css',

        pathCSS + 'overrides.css',
    ], public + '/css/admin.css');

    var pathJS = path + '/js/';
    // admin javascripts
    mix.scripts([
        // jquery
        pathJS + 'vendor/jquery-3.2.1.js',

        // bootstrap
        pathJS + 'vendor/bootstrap.js',

        // plugins
        pathJS + 'vendor/pace.js',
        pathJS + 'vendor/chart.js',
        pathJS + 'vendor/select2.js',
        pathJS + 'vendor/dropzone.js',
        pathJS + 'vendor/lightbox.js',
        pathJS + 'plugins/fastclick.js',
        pathJS + 'vendor/summernote.js',
        pathJS + 'vendor/jquery.nestable.js',
        pathJS + 'vendor/jquery.cookie.js',
        pathJS + 'vendor/cropper.js',

        // date picker
        pathJS + 'vendor/moment.js',
        pathJS + 'vendor/daterangepicker.js',
        pathJS + 'vendor/bootstrap-datetimepicker.js',

        // datatables | 1.10.11
        // https://datatables.net/extensions/responsive/classes
        pathJS + 'vendor/jquery.datatables.js',
        pathJS + 'vendor/datatables.bootstrap.js',
        pathJS + 'vendor/datatables.responsive.js',

        // titan
        pathJS + 'titan/titan.js',
        pathJS + 'titan/buttons.js',
        pathJS + 'titan/notify.js',
        pathJS + 'titan/datatables.js',
        pathJS + 'titan/google_maps.js',
        pathJS + 'titan/notifications.js',

        // admin
        pathJS + 'admin-lte.js',
        pathJS + 'admin.js',

    ], public + '/js/admin.js');
}