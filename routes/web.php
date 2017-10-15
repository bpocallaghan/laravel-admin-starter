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
Route::redirect('/home', '/');
Route::group(['namespace' => 'Website'], function () {
    Route::get('/', 'HomeController@index');
    //Route::get('/about', 'AboutController@index');
    Route::get('/contact-us', 'ContactUsController@index');
    Route::post('/contact-us/submit', 'ContactUsController@feedback');
    Route::get('/contact-us/post-offices', 'PostOfficesController@index');

    // faq
    Route::get('/faq', 'FAQController@index');
    Route::post('/faq/question/{faq}/{type?}', 'FAQController@incrementClick');

    // content
    Route::get('/changelog', 'PagesController@changelog');
    Route::get('/testimonials', 'PagesController@testimonials');
    Route::get('/pricing', 'PricingController@index');

    // gallery
    Route::get('/gallery', 'GalleryController@index');
    Route::get('/gallery/{albumSlug}', 'GalleryController@showAlbum');

    // blog / articles
    Route::get('/blog', 'BlogController@index');
    Route::get('/blog/{articleSlug}', 'BlogController@show');
    // news and events
    Route::get('/news-and-events', 'NewsEventController@index');
    Route::get('/news-and-events/{newsSlug}', 'NewsEventController@show');

    // corporate
    Route::get('/corporate/tenders', 'CorporateController@tenders');
    Route::get('/corporate/vacancies', 'CorporateController@vacancies');
    Route::get('/corporate/annual-reports', 'CorporateController@annualReports');
    Route::post('/corporate/tenders/{tender}/download', 'CorporateController@downloadTender');
    Route::post('/corporate/vacancies/{vacancy}/download', 'CorporateController@downloadVacancy');
    Route::post('/corporate/annual-reports/{annual_report}/download',
        'CorporateController@downloadAnnualReport');
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

            Route::resource('clients', 'ClientsController');
        });

        // pages order
        Route::group(['prefix' => 'pages', 'namespace' => 'Pages'], function () {
            Route::get('/order/{type?}', 'OrderController@index');
            Route::post('/order/{type?}', 'OrderController@updateOrder');

            // manage page sections list order
            Route::get('/{page}/sections', 'SectionsController@index');
            Route::post('/{page}/sections/order', 'SectionsController@updateOrder');
            Route::delete('/{page}/sections/{section}', 'SectionsController@destroy');

            // page components
            Route::resource('/{page}/sections/content', 'PageContentController');
            Route::resource('/{page}/sections/media', 'PageMediaController');
            Route::resource('/{page}/sections/gallery', 'PageGalleryController');
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

        // corporate
        Route::group(['prefix' => 'corporate', 'namespace' => 'Corporate'], function () {
            Route::resource('tenders', 'TendersController');
            Route::resource('vacancies', 'VacanciesController');
            Route::resource('annual-reports', 'AnnualReportsController');
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
        });

        // faq
        Route::resource('/faqs/categories', 'Faq\CategoriesController');
        Route::get('faqs/order', 'Faq\OrderController@index');
        Route::post('faqs/order', 'Faq\OrderController@updateOrder');
        Route::resource('/faqs', 'Faq\FaqsController');

        // corporate
        Route::group(['prefix' => 'newsletter', 'namespace' => 'Newsletter'], function () {
            Route::resource('subscribers', 'SubscribersController');
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

            // changelogs
            Route::resource('changelogs', 'ChangelogsController');

            // settings
            Route::resource('settings', 'SettingsController');

            // subscription plans
            Route::resource('subscription-plans/features', 'FeaturesController');
            Route::resource('subscription-plans', 'SubscriptionPlansController');
            Route::get('subscription-plans/{subscription_plan}/features/order',
                'SubscriptionPlansController@showFeaturesOrder');
            Route::post('subscription-plans/{subscription_plan}/features/order',
                'SubscriptionPlansController@updateFeaturesOrder');

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