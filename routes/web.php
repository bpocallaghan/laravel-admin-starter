<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
|------------------------------------------
| Website
|------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/about', 'AboutController@index');
    Route::get('/contact-us', 'ContactUsController@index');
    Route::post('/contact-us/submit', 'ContactUsController@feedback');

    Route::get('/pages/1-column', 'PagesController@column1');
    Route::get('/pages/2-column', 'PagesController@column2');
    Route::get('/pages/3-column', 'PagesController@column3');
    Route::get('/pages/4-column', 'PagesController@column4');
    Route::get('/pages/pricing', 'PagesController@pricing');
});

/*
|------------------------------------------
| Admin Auth
|------------------------------------------
*/
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    // logout
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::post('logout', 'LoginController@logout');

    // login
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');

    // registration
    Route::get('register/{token}', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
    Route::get('register/confirm/{token}', 'RegisterController@confirmRegister');

    // password reset
    Route::get('password/forgot', 'ForgotPasswordController@showLinkRequestForm')->name('forgot-password');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

/*
|------------------------------------------
| Admin (when authorized and admin)
|------------------------------------------
*/
Route::group(['middleware' => ['auth', 'auth.admin'], 'prefix' => 'admin', 'namespace' => 'Admin'],
    function () {
        Route::get('/', 'DashboardController@index')->name('admin');

        // profile
        Route::get('/profile', 'ProfileController@index');
        Route::put('/profile/{user}', 'ProfileController@update');

        // analytics
        Route::group(['prefix' => 'analytics'], function () {
            Route::get('/', 'AnalyticsController@summary');
            Route::get('/devices', 'AnalyticsController@devices');
            Route::get('/visits-and-referrals', 'AnalyticsController@visitsReferrals');
            Route::get('/interests', 'AnalyticsController@interests');
            Route::get('/demographics', 'AnalyticsController@demographics');
        });

        // history
        Route::group(['prefix' => 'history', 'namespace' => 'History'], function () {
            Route::get('/', 'HistoryController@website');
            Route::get('/admin', 'HistoryController@admin');
            Route::get('/website', 'HistoryController@website');
        });

        Route::group(['prefix' => 'general'], function () {
            Route::resource('banners', 'BannersController');

            // testimonials
            Route::get('testimonials/order', 'TestimonialsOrderController@index');
            Route::post('testimonials/order', 'TestimonialsOrderController@updateOrder');
            Route::resource('testimonials', 'TestimonialsController');

            // locations
            Route::group(['prefix' => 'locations', 'namespace' => 'Locations'], function () {
                Route::resource('suburbs', 'SuburbsController');
                Route::resource('cities', 'CitiesController');
                Route::resource('provinces', 'ProvincesController');
                Route::resource('countries', 'CountriesController');
            });
        });

        // reports
        Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
            Route::get('summary', 'SummaryController@index');

            // feedback contact us
            Route::get('contact-us', 'ContactUsController@index');
            Route::post('contact-us/chart', 'ContactUsController@getChartData');
            Route::get('contact-us/datatable', 'ContactUsController@getTableData');
        });

        // settings / website
        Route::group(['prefix' => 'settings/website', 'namespace' => 'Settings\Website'],
            function () {
                // navigation
                Route::group(['prefix' => 'navigation/order'], function () {
                    Route::get('{type?}', 'NavigationOrderController@index');
                    Route::post('{type?}', 'NavigationOrderController@updateOrder');
                });
                Route::resource('navigation', 'NavigationController');

                // changelogs
                Route::resource('changelogs', 'ChangelogsController');
            });

        // settings / admin
        Route::group(['prefix' => 'settings/admin', 'namespace' => 'Settings\Admin'], function () {
            // users
            Route::get('users', 'AdministratorsController@index');
            Route::get('users/invites', 'AdministratorsController@showInvites');
            Route::post('users/invites', 'AdministratorsController@postInvite');

            // navigation
            Route::get('navigation/order', 'NavigationOrderController@index');
            Route::post('navigation/order', 'NavigationOrderController@updateOrder');
            Route::get('navigation/datatable', 'NavigationController@getTableData');
            Route::resource('navigation', 'NavigationController');
        });
    });

/*
|--------------------------------------------------------------------------
| AJAX ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'middleware' => 'web'], function () {
    // logs
    Route::group(['prefix' => 'log'], function () {
        Route::post('social-media', 'LogsController@socialMedia');
    });
});