<?php

/*
|--------------------------------------------------------------------------
| Vendor Web Routes
|--------------------------------------------------------------------------
|
| Here is where the bpocallaghan/[package-name] routes for your
| application will be registered. The routes are loaded by the
| RouteServiceProvider within the "web" middleware group.
| The reason for this is the 'prefix' namespace for controllers.
|
*/

/*
|--------------------------------------------------------------------------
| WEBSITE
|--------------------------------------------------------------------------
*/
// faq
Route::group(['prefix' => 'faq', 'namespace' => 'FAQ\Controllers\Website'], function () {
    Route::get('', 'FAQController@index');
    Route::post('/question/{faq}/{type?}', 'FAQController@incrementClick');
});

// changelogs
Route::resource('changelog', 'Changelogs\Controllers\Website\ChangelogsController');

// testimonials
Route::resource('testimonials', 'Testimonials\Controllers\Website\TestimonialsController');

// corporate
Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate\Controllers\Website'],
    function () {
        Route::get('/tenders', 'CorporateController@tenders');
        Route::get('/vacancies', 'CorporateController@vacancies');
        Route::get('/annual-reports', 'CorporateController@annualReports');
        Route::post('/tenders/{tender}/download', 'CorporateController@downloadTender');
        Route::post('/vacancies/{vacancy}/download', 'CorporateController@downloadVacancy');
        Route::post('/annual-reports/{annual_report}/download',
            'CorporateController@downloadAnnualReport');
    });

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth', 'auth.admin']
], function () {

    // faq
    Route::group(['namespace' => 'FAQ\Controllers\Admin'], function () {
        Route::resource('/faqs/categories', 'CategoriesController');
        Route::get('faqs/order', 'OrderController@index');
        Route::post('faqs/order', 'OrderController@updateOrder');
        Route::resource('/faqs', 'FAQsController');
    });

    // changelogs
    Route::resource('settings/changelogs', 'Changelogs\Controllers\Admin\ChangelogsController');

    // testimonials
    Route::group(['prefix' => 'general', 'namespace' => 'Testimonials\Controllers\Admin'], function () {
        Route::get('testimonials/order', 'OrderController@index');
        Route::post('testimonials/order', 'OrderController@updateOrder');
        Route::resource('testimonials', 'TestimonialsController');
    });

    // corporate
    Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate\Controllers\Admin'],
        function () {
            Route::resource('tenders', 'TendersController');
            Route::resource('vacancies', 'VacanciesController');
            Route::resource('annual-reports', 'AnnualReportsController');
        });
});