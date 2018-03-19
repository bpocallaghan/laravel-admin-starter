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
| Localization
|------------------------------------------
*/
Route::get('locale', function () {
    return \App::getLocale();
});

Route::get('locale/{locale}', function ($locale) {
    \Session::put('locale', $locale);
    return redirect()->back();
});

Route::post('/language-chooser', 'LanguageController@changeLanguage');
Route::post('/language/', array('before' => 'csrf', 'as' => 'language-chooser', 'uses' => 'LanguageController@changeLanguage' ));

/*
|------------------------------------------
| Website
|------------------------------------------
*/
Route::redirect('/home', '/');
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
    Route::any('logout', 'LoginController@logout')->name('logout');

    Route::group(['middleware' => 'guest'], function () {
        // login
        Route::get('login', 'LoginController@showLoginForm')->name('login');
        Route::post('login', 'LoginController@login');

        // registration
        Route::get('register/{token?}', 'RegisterController@showRegistrationForm')
            ->name('register');
        Route::post('register', 'RegisterController@register');
        Route::get('register/confirm/{token}', 'RegisterController@confirmAccount');

        // password reset
        Route::get('password/forgot', 'ForgotPasswordController@showLinkRequestForm')
            ->name('forgot-password');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
            ->name('password.reset');
        Route::post('password/reset', 'ResetPasswordController@reset');
    });
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
        Route::group(['prefix' => 'latest-activity', 'namespace' => 'History'], function () {
            Route::get('/', 'HistoryController@website');
            Route::get('/admin', 'HistoryController@admin');
            Route::get('/website', 'HistoryController@website');
        });

        Route::group(['prefix' => 'general'], function () {
            Route::resource('tags', 'TagsController');

            Route::get('/banners/order', 'BannersOrderController@index');
            Route::post('/banners/order', 'BannersOrderController@update');
            Route::resource('banners', 'BannersController');

            Route::resource('clients', 'ClientsController');
            Route::post('clients/password/email', 'ClientsController@sendResetLinkEmail');
        });

        // pages order
        Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {
            Route::get('/order/{type?}', 'OrderController@index');
            Route::post('/order/{type?}', 'OrderController@updateOrder');

            // manage page sections list order
            Route::get('/{page}/sections', 'PageContentController@index');
            Route::post('/{page}/sections/order', 'PageContentController@updateOrder');
            Route::delete('/{page}/sections/{section}', 'PageContentController@destroy');

            // page components
            Route::resource('/{page}/sections/content', 'PageContentController');
        });
        Route::resource('pages', 'Pages\PagesController');

        // blog
        Route::group(['prefix' => 'blog', 'namespace' => 'Blog'], function () {
            Route::get('/', function () {
                return redirect('/admin/blog/articles');
            });
            Route::resource('categories', 'CategoriesController');
            Route::resource('articles', 'ArticlesController');
        });

        // news and events
        Route::group(['prefix' => 'news-and-events', 'namespace' => 'NewsEvents'], function () {
            Route::resource('news', 'NewsController');
            Route::resource('categories', 'CategoriesController');
        });

        // gallery / photos
        Route::group(['prefix' => 'photos', 'namespace' => 'Photos'], function () {
            Route::get('/', 'PhotosController@index');
            Route::delete('/{photo}', 'PhotosController@destroy');
            Route::post('/upload', 'PhotosController@uploadPhotos');
            Route::post('/{photo}/edit/name', 'PhotosController@updatePhotoName');
            Route::post('/{photo}/cover', 'PhotosController@updatePhotoCover');

            // photoables
            Route::get('/news/{news}', 'PhotosController@showNewsPhotos');
            Route::get('/articles/{article}', 'PhotosController@showArticlePhotos');

            Route::resource('/albums', 'AlbumsController', ['except' => 'show']);
            Route::get('/albums/{album}', 'PhotosController@showAlbumPhotos');

            // croppers
            Route::post('/crop/{photo}', 'CropperController@cropPhoto');
            Route::get('/news/{news}/crop/{photo}', 'CropperController@showNewsPhoto');
            Route::get('/albums/{album}/crop/{photo}', 'CropperController@showAlbumsPhoto');
            Route::get('/articles/{article}/crop/{photo}', 'CropperController@showArticlesPhoto');

            // resource image crop
            Route::post('/crop-resource', 'CropResourceController@cropPhoto');
            Route::get('/banners/{banner}/crop-resource/', 'CropResourceController@showBanner');
        });

        // corporate
        Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
            Route::resource('subscribers', 'SubscribersController');
        });

        // documents
        Route::group(['prefix' => 'documents', 'namespace' => 'Documents'], function () {
            // documents
            Route::get('/', 'DocumentsController@index');
            Route::delete('/{document}', 'DocumentsController@destroy');
            Route::post('/upload', 'DocumentsController@upload');
            Route::post('/{document}/edit/name', 'DocumentsController@updateName');

            // documentable
            Route::get('/category/{category}', 'DocumentsController@showCategory');

            // categories
            Route::resource('/categories', 'CategoriesController');
        });

        // reports
        Route::group(['prefix' => 'reports', 'namespace' => 'Reports'], function () {
            Route::get('summary', 'SummaryController@index');

            // feedback contact us
            Route::get('contact-us', 'ContactUsController@index');
            Route::post('contact-us/chart', 'ContactUsController@getChartData');
            Route::get('contact-us/datatable', 'ContactUsController@getTableData');
        });

        Route::group(['prefix' => 'settings', 'namespace' => 'Settings'], function () {
            Route::resource('roles', 'RolesController');

            // settings
            Route::resource('settings', 'SettingsController');

            // users
            Route::get('administrators/invites', 'AdministratorsController@showInvites');
            Route::post('administrators/invites', 'AdministratorsController@postInvite');
            Route::resource('administrators', 'AdministratorsController');

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

/*
|--------------------------------------------------------------------------
| Website Dynamic Pages
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Website'], function () {
    Route::get('{slug1}/{slug2?}/{slug3?}', 'PagesController@index');
});