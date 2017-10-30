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
// changelogs
Route::resource('changelog', 'Changelogs\Controllers\Website\ChangelogsController');

// corporate
Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate\Controllers\Website'], function () {
    Route::get('/tenders', 'CorporateController@tenders');
    Route::get('/vacancies', 'CorporateController@vacancies');
    Route::get('/annual-reports', 'CorporateController@annualReports');
    Route::post('/tenders/{tender}/download', 'CorporateController@downloadTender');
    Route::post('/vacancies/{vacancy}/download', 'CorporateController@downloadVacancy');
    Route::post('/annual-reports/{annual_report}/download', 'CorporateController@downloadAnnualReport');
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

    // changelogs
    Route::resource('settings/changelogs', 'Changelogs\Controllers\Admin\ChangelogsController');

    // corporate
    Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate\Controllers\Admin'], function () {
        Route::resource('tenders', 'TendersController');
        Route::resource('vacancies', 'VacanciesController');
        Route::resource('annual-reports', 'AnnualReportsController');
    });
});