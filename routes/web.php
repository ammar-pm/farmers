<?php


Route::get('/language/{lang}/{source}/{ds_id}', 'LanguageController@index');

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::get('/redirect/google', 'SocialAuthController@google')->name('social.redirect');
Route::get('/callback/google', 'SocialAuthController@callbackGoogle');

// Auth
Route::group(['middleware' => ['auth']], function () {

    Route::get('logout', 'Auth\LoginController@logout');

    // Favorites
    Route::get('favorites', 'FavoriteController@index');

    Route::get('/favorite/{id}', 'FavoriteController@favorite');
    Route::get('vizbi/bubble/{id}', 'GapminderController@vizbi');
    Route::get('vizbi/line/{id}', 'GapminderController@vizbi_line');
    Route::get('vizbi/bar/{id}', 'GapminderController@vizbi_bar');


});

// Editor
Route::group(['middleware' => ['auth', 'iseditor']], function () {

    Route::get('home', function () {
        return redirect('/');
    });

	Route::get('/dashboard', function () {
    return view('dashboard');
	});

	Route::resource('posts', 'PostController');
	Route::resource('datasets', 'DatasetController');
	Route::get('datasets/file/download/{id}', 'DatasetController@download');
	Route::resource('files', 'FileController');
	Route::get('delete/file/{id}/{page}', 'FileController@destroy')->name('file.delete');

    Route::get('help', 'HelpController@index');
    // test **
    //Route::get('tests', 'TestController@index');
    Route::get('vizbi/bubble/{id}', 'GapminderController@vizbi');
    Route::get('vizbi/line/{id}', 'GapminderController@vizbi_line');
    Route::get('vizbi/bar/{id}', 'GapminderController@vizbi_bar');

});


// Admin
Route::group(['middleware' => ['auth', 'isadmin']], function () {


    Route::resource('widgets', 'WidgetController');
    Route::resource('menus', 'MenuController');
    Route::resource('periods', 'PeriodController');
    Route::resource('topics', 'TopicController')->except(['show']);
    Route::resource('governorates', 'GovernorateController')->except(['show']);
    Route::resource('indicators', 'IndicatorController');
    Route::patch('users/restore_deleted_user/{id}', 'UserController@restore_deleted_user');
    Route::get('users/get_trashed_users', 'UserController@get_trashed_users');
    Route::resource('users', 'UserController');
    Route::resource('messages', 'MessageController');

    // Settings
    Route::get('settings', 'SettingController@spark');
    Route::get('app/settings', 'SettingController@index');
    Route::post('app/settings/update', 'SettingController@update');
    Route::get('vizbi/bubble/{id}', 'GapminderController@vizbi');
    Route::get('vizbi/line/{id}', 'GapminderController@vizbi_line');
    Route::get('vizbi/bar/{id}', 'GapminderController@vizbi_bar');

	Route::get('/dashboard', function () {
    return view('dashboard');
	});

});

// Site
Route::group(['middleware' => ['web']], function () {

	Route::get('/', 'SiteController@index');
    Route::get('/about', 'SiteController@about');
    Route::get('/faqs', 'SiteController@faq');
    //Route::get('/contact_us', 'SiteController@contact_us');
    Route::get('/contact_us', 'MessageController@contact_us');
    Route::post('/contact_us', 'MessageController@store');
	//Route::get('/library/{ds_id?}', 'SiteController@library')->name('library');
    //Route::get('/library/{id}', 'SiteController@library_topic');
	Route::get('/stories', 'SiteController@stories');
	Route::get('/stories/{id}', 'SiteController@story');
	Route::get('/news', 'SiteController@news');
	Route::get('/news/{id}', 'SiteController@article');
	Route::get('pages/{id}', 'SiteController@pages');
	Route::get('topics', 'SiteController@topics');
	Route::get('library/{id?}/{ds_id?}', 'SiteController@topic')->name('library_topic');
	Route::get('governorates/{id}', 'GovernorateController@show');
    Route::get('vizbi/bubble/{id}', 'GapminderController@vizbi');
    Route::get('vizbi/line/{id}', 'GapminderController@vizbi_line');
    Route::get('vizbi/bar/{id}', 'GapminderController@vizbi_bar');
    Route::get('datasets/file/download/{id}', 'DatasetController@download');

});