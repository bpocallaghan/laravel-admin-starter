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
| WEBSITE
|------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {

    Route::get('/', 'HomeController@index');
    Route::get('/about', 'AboutController@index');
    Route::get('/contact-us', 'ContactUsController@index');
    Route::post('/contact-us/submit', 'ContactUsController@feedback');
});

/*
|------------------------------------------
| AUTH ROUTES
|------------------------------------------
*/
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {

    // authentication
    Route::get('login', 'AuthController@showLoginForm')->name('login');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');

    // registration
    Route::get('register/{token}', 'AuthController@showRegistrationForm');
    Route::post('register', 'AuthController@register');
    Route::get('register/confirm/{token}', 'AuthController@confirmRegister')
        ->where('token', '[0-9a-zA-Z]+');

    // password reset
    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');
    Route::get('password/reset/{token}', 'PasswordController@showResetForm');
    Route::post('password/reset', 'PasswordController@reset');
});

/*
|------------------------------------------
| ADMIN ROUTES (when authorized)
|------------------------------------------
*/
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('/', 'DashboardController@index');
    Route::post('/analytics/keywords', 'DashboardController@getKeywords');
    Route::post('/analytics/visitors', 'DashboardController@getVisitors');
    Route::post('/analytics/browsers', 'DashboardController@getBrowsers');
    Route::post('/analytics/visited-pages', 'DashboardController@getVisitedPages');
    Route::post('/analytics/unique-visitors', 'DashboardController@getUniqueVisitors');
    Route::post('/analytics/visitors-views', 'DashboardController@getVisitorsAndPageViews');
    Route::post('/analytics/bounce-rate', 'DashboardController@getBounceRate');
    Route::post('/analytics/page-load', 'DashboardController@getAvgPageLoad');

    // tags
    Route::resource('tags', 'TagsController');

    // geography
    Route::group(['prefix' => 'geography', 'namespace' => 'Geography'], function () {
        Route::resource('cities', 'CitiesController');
        Route::resource('countries', 'CountriesController');
    });

    // reports
    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
        Route::get('summary', 'SummaryController@index');

        Route::group(['prefix' => 'feedback', 'namespace' => 'Feedback'], function () {
            // feedback contact us
            Route::get('contact-us', 'ContactUsController@index');
            Route::post('contact-us/chart', 'ContactUsController@getChartData');
            Route::get('contact-us/datatable', 'ContactUsController@getTableData');
        });
    });

    // profile
    Route::get('profile', 'ProfileController@index');
    Route::put('profile/{user}', 'ProfileController@update');

    // settings / website
    Route::group(['prefix' => 'settings/website', 'namespace' => 'Settings\Website'], function () {

        // navigation order
        Route::group(['prefix' => 'navigation/order'], function () {
            Route::get('{type?}', 'NavigationOrderController@index');
            Route::post('{type?}', 'NavigationOrderController@updateOrder');
        });

        // navigation
        Route::resource('navigation', 'NavigationController');
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