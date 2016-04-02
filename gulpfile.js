var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    var COMPILE = 'all';

    var public = 'public';
    var pathBase = 'resources/assets';

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
        mix.copy(pathBase + '/admin/images', public + '/images/admin');

        elixir.config.css.sass.folder = "admin/sass";

        mix.styles([
            'bootstrap.css',
            'font-awesome.css',
            'ionicons.css',

            // plugins
            'plugins/select2.css',
            'plugins/lightbox.css',
            'plugins/dropzone.css',
            'plugins/summernote.css',
            'plugins/daterangepicker.css',
            'plugins/pace-theme-flash.css',
            'plugins/bootstrap-datetimepicker.css',
            'plugins/datatables/dataTables.bootstrap.css',
            'plugins/datatables/responsive.bootstrap.css',

            // admin
            'admin-lte.css',
            'skins/skin-blue.css',

            // titan
            'titan/titan.css',
            'titan/charts.css',
            'titan/superbox.css',
            'titan/nestable.css',
            'titan/datatables.css',
            'titan/checkboxes.css',

            'titan/notify.css',
        ], public + '/css/admin/', path + 'css/');

        // admin javascripts
        mix.scripts([
            // jquery
            'jquery-2.2.1.js',

            // bootstrap
            'bootstrap.js',

            // plugins
            'plugins/pace.js',
            'plugins/chart.js',
            'plugins/select2.js',
            'plugins/dropzone.js',
            'plugins/lightbox.js',
            'plugins/fastclick.js',
            'plugins/summernote.js',
            'plugins/jquery.nestable.js',

            // date picker
            'plugins/moment.js',
            'plugins/daterangepicker.js',
            'plugins/bootstrap-datetimepicker.js',

            // datatables | 1.10.11
            // https://datatables.net/extensions/responsive/classes
            'plugins/datatables/jquery.dataTables.js',
            'plugins/datatables/dataTables.bootstrap.js',
            'plugins/datatables/dataTables.responsive.js',

            // titan
            'titan/titan.js',
            'titan/datatables.js',
            'titan/google_maps.js',

            'titan/notify.js',

            // admin
            'admin-lte.js',
            'admin.js',

        ], public + '/js/admin/', path + 'js/');
    }

    if (COMPILE == 'website' || COMPILE == 'all') {

        // website stylesheets
        var path = pathBase + '/website/';

        // copy all the fonts
        mix.copy(path + 'fonts', public + '/fonts');

        // copy all the images
        mix.copy(path + 'images', public + '/images');

        mix.styles([
            'bootstrap.css',
            'website.css',
        ], public + '/css/', path + 'css/');

        // admin javascripts
        mix.scripts([
            // jquery
            'jquery-2.2.1.js',
            // bootstrap
            'bootstrap.js',
        ], public + '/js/', path + 'js/');
    }

    //mix.version(['css/all.css', 'js/all.js']);
});
