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
});