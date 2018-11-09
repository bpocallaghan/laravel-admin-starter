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

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|------------------------------------------
| Website
|------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {
    Route::get('/', 'HomeController@index');
    Route::get('/contact-us', 'ContactUsController@index');
    Route::post('/contact-us/submit', 'ContactUsController@feedback');

    // gallery
    Route::get('/gallery', 'GalleryController@index');
    Route::get('/gallery/{albumSlug}', 'GalleryController@showAlbum');

    // blog / articles
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/{articleSlug}', 'BlogController@show');

    // news and events
    Route::get('/news-and-events', 'NewsEventController@index');
    Route::get('/news-and-events/{newsSlug}', 'NewsEventController@show');
});

/*
|------------------------------------------
| Website Account
|------------------------------------------
*/
Route::group(['middleware' => ['auth'], 'prefix' => 'account', 'namespace' => 'Website\Account'],
    function () {
        Route::get('/', 'AccountController@index')->name('account');
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile', 'ProfileController@update');
    });

/*
|------------------------------------------
| Authenticate User
|------------------------------------------
*/
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    // logout (get or post)

    Route::group(['middleware' => 'guest'], function () {
        // login

    });
});

/*
|------------------------------------------
| Admin (when authorized and admin)
|------------------------------------------
*/
Route::group(['middleware' => ['auth', 'auth.admin'], 'prefix' => 'admin', 'namespace' => 'Admin'],
    function () {

    });

/*
|--------------------------------------------------------------------------
| AJAX ROUTES
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'ajax', 'namespace' => 'Ajax', 'middleware' => 'web'], function () {
    // logs
    Route::group(['prefix' => 'log'], function () {

    });
});

Route::group(['prefix' => 'tests', 'namespace' => 'Tests'], function () {
    //Route::get('/email/{to?}', 'MailController@index');
});

/*
|--------------------------------------------------------------------------
| Website Dynamic Pages
| This must be at the end of the file for the admin page builder
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {
    Route::get('{slug1}/{slug2?}/{slug3?}', 'PagesController@index');
});
