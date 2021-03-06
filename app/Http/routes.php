<?php
Route::post('static_image/upload', 'PageController@upload');
Route::group(['middleware' => ['guest']], function () {
    /*
    |--------------------------------------------------------------------------
    | Login Route
    |--------------------------------------------------------------------------
     */
    Route::post('authenticate', 'Auth\AuthController@authenticate');
    Route::get('login', 'Auth\AuthController@login');

    /*
    |--------------------------------------------------------------------------
    | Registration Route
    |--------------------------------------------------------------------------
     */
    Route::get('register', 'Auth\AuthController@register');
    Route::post('register', 'MerchantController@store');

    /*
    |--------------------------------------------------------------------------
    | Password Reset Route
    |--------------------------------------------------------------------------
     */
    Route::get('password', 'Auth\PasswordController@index');
    Route::post('password/reset', 'Auth\PasswordController@reset');
});

Route::group(['middleware' => ['auth']], function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard Route
    |--------------------------------------------------------------------------
     */
    Route::get('dashboard', 'DashboardController@index');
    Route::post('dashboard/report/generate', 'DashboardController@generateReport');
    Route::get('dashboard/getLastSevenDays/{field}', 'DashboardController@getLastSevenDays');

    /*
    |--------------------------------------------------------------------------
    | Featured Section Route
    |--------------------------------------------------------------------------
     */
    Route::resource('featured-section', 'FeaturedSectionController', ['except' => ['show', ' destroy']]);
    Route::get('featured-section/{featured_section_id}', 'FeaturedSectionController@destroy');
    Route::get('featured-section/move/{merchant_id}/{featured_section_id}/{direction}', 'FeaturedSectionController@move');
    Route::post('featured-section/uploadImage', 'FeaturedSectionController@uploadImage');
    Route::post('featured-section/updateImage/{position_id}', 'FeaturedSectionController@updateImage');

    /*
    |--------------------------------------------------------------------------
    | Campaign Route
    |--------------------------------------------------------------------------
     */
    Route::resource('campaigns', 'CampaignController');
    Route::put('campaigns/withdraw/{campaigns_id}', 'CampaignController@withdraw');
    Route::put('campaigns/updateStatus/{campaigns_id}', 'CampaignController@updateStatus');
    Route::put('campaigns/updateCamRead/{campaigns_id}', 'CampaignController@updateCamRead');
    Route::post('campaigns/markAllAsRead', 'CampaignController@markAllAsRead');
    Route::post('campaigns/duplicate/{campaigns_id}', 'CampaignController@duplicate');

    Route::put('campaigns/updateNotifNotToRead/{notification_id}', 'NotificationsController@updateNotifNotToRead');
    Route::put('campaigns/updateNotifToRead/{notification_id}', 'NotificationsController@updateNotifToRead');
    Route::post('campaigns/report/generate', 'CampaignController@generateReport');
    Route::post('campaigns/report/generate/{campaigns_id}', 'CampaignController@generateCampaignReport');

    Route::get('campaigns/getLastSevenDays/{campaigns_id}/{field}', 'CampaignController@getLastSevenDays');

    Route::get('campaigns/search/{search_word}/{search_type}', 'CampaignController@getSearchResult');
    Route::get('campaigns/search/show/{search_word}/{search_type}', 'CampaignController@getSearchResult');
    Route::get('campaigns/category/{status}', 'CampaignController@displayByStatus');

    /*
    |--------------------------------------------------------------------------
    | Blurb Route
    |--------------------------------------------------------------------------
     */
    Route::get('blurb/create/{control_no}', 'BlurbController@create');
    Route::post('blurb', 'BlurbController@store');
    Route::post('blurb/store', 'BlurbController@store');
    Route::get('blurb/edit/{blurb_id}/{control_no}', 'BlurbController@edit');
    Route::get('blurb/{blurb_id}/{control_no}', 'BlurbController@show');
    Route::get('blurb/{blurb_id}/{control_no}/result', 'BlurbController@showPerformance');
    Route::put('blurb/{blurb_id}', 'BlurbController@update');
    Route::delete('blurb/{blurb_id}/{control_no}', 'BlurbController@destroy');
    Route::post('blurb/upload/{campaign_id}', 'BlurbController@uploadLogo');
    Route::post('blurb/updateLogo/{blurb_id}/{campaign_id}', 'BlurbController@updateLogo');
    Route::get('blurb/view/{control_no}/{cam_status}', 'BlurbController@view');
    Route::get('blurb/merchant/view/{control_no}/{cam_status}', 'BlurbController@viewPerformance');
    Route::get('blurb/getLastSevenDays/{blurb_id}/{field}', 'BlurbController@getLastSevenDays');
    Route::post('blurb/report/generate', 'BlurbController@generateReport');
    Route::post('blurb/report/generate/{blurb_id}', 'BlurbController@generateBlurbReport');

    /*
    |--------------------------------------------------------------------------
    | Merchant Route
    |--------------------------------------------------------------------------
     */
    Route::resource('merchants', 'MerchantController');
    Route::put('merchants/withdraw/{merchant_id}', 'MerchantController@withdraw');
    Route::put('merchants/updateStatus/{merchant_id}', 'MerchantController@updateStatus');
    Route::put('merchants/updateCamRead/{merchant_id}', 'MerchantController@updateCamRead');
    Route::post('merchants/markAllAsRead', 'MerchantController@markAllAsRead');
    Route::post('merchants/duplicate/{merchant_id}', 'MerchantController@duplicate');

    Route::put('merchants/updateNotifNotToRead/{notification_id}', 'NotificationsController@updateNotifNotToRead');
    Route::put('merchants/updateNotifToRead/{notification_id}', 'NotificationsController@updateNotifToRead');
    Route::post('merchants/report/generate', 'MerchantController@generateReport');
    Route::post('merchants/report/generate/{merchant_id}', 'MerchantController@generateCampaignReport');

    Route::get('merchants/getLastSevenDays/{merchant_id}/{field}', 'MerchantController@getLastSevenDays');

    Route::get('merchants/search/{search_word}/{search_type}', 'MerchantController@getSearchResult');
    Route::get('merchants/search/show/{search_word}/{search_type}', 'MerchantController@getSearchResult');

    Route::put('merchants/company/{merchant_id}', 'CompanyController@update');
    Route::put('merchants/outlet/{outlet_id}', 'OutletController@update');
    Route::put('merchants/restaurant/{restaurant_id}', 'RestaurantController@update');
    Route::post('merchants/restaurant/upload-pp/{restaurant_id}', 'RestaurantController@uploadProfilePicture');
    Route::post('merchants/restaurant/upload-cp/{restaurant_id}', 'RestaurantController@uploadCoverPhoto');

    Route::get('merchants/{campaign_id}/create-campaign', 'MerchantController@createCampaign');
    Route::get('merchants/{campaign_id}/edit-campaign', 'MerchantController@editCampaign');

    Route::get('merchants/{blurb_id}/{cam_control_no}/create-blurb', 'MerchantController@createBlurb');
    Route::get('merchants/{blurb_id}/{cam_control_no}/edit-blurb', 'MerchantController@editBlurb');

    Route::get('merchants/category/{status}', 'MerchantController@displayByStatus');

    /*
    |--------------------------------------------------------------------------
    | Administrator Route
    |--------------------------------------------------------------------------
     */
    Route::resource('administrators', 'AdministratorController');
    Route::get('administrators/search/{search_word}/{search_type}', 'AdministratorController@getSearchResult');
    Route::post('administrators/generate', 'AdministratorController@generateReport');
    Route::get('administrators/category/{status}', 'AdministratorController@displayByStatus');

    /*
    |--------------------------------------------------------------------------
    | App Users
    |--------------------------------------------------------------------------
     */
    Route::resource('app-users', 'AppUserController');
    Route::get('app-users/search/{search_word}/{search_type}', 'AppUserController@getSearchResult');
    Route::post('app-users/generate', 'AppUserController@generateReport');
    Route::get('app-users/category/{status}', 'AppUserController@displayByStatus');

    /*
    |--------------------------------------------------------------------------
    | Pages Route
    |--------------------------------------------------------------------------
     */
    Route::get('pages/{page_id}/edit', 'PageController@index');
    Route::put('pages/{page_id}', 'PageController@update');

    /*
    |--------------------------------------------------------------------------
    | Outlets Route
    |--------------------------------------------------------------------------
     */
    Route::resource('outlets', 'OutletController', ['except' => ['show', 'index', 'create', 'edit']]);
    Route::get('outlets/{outlet_id}/create', 'OutletController@create');
    Route::get('outlets/edit/{outlet_id}/{merchant_id_id}', 'OutletController@edit');

    /*
    |--------------------------------------------------------------------------
    | Pages Route
    |--------------------------------------------------------------------------
     */
    Route::get('pages/{page_id}/edit', 'PageController@index');
    Route::put('pages/{page_id}', 'PageController@update');

    /*
    |--------------------------------------------------------------------------
    | Setting Route
    |--------------------------------------------------------------------------
     */
    Route::get('settings', 'SettingsController@index');

    /* Cuisine */
    Route::post('settings/cuisine/store', 'CuisineController@store');
    Route::put('settings/cuisine/{cuisine_id}', 'CuisineController@update');
    Route::delete('settings/cuisine/{cuisine_id}', 'CuisineController@destroy');

    /* Blurb Category */
    Route::post('settings/blurb-category/store', 'BlurbCategoryController@store');
    Route::put('settings/blurb-category/{cuisine_id}', 'BlurbCategoryController@update');
    Route::delete('settings/blurb-category/{cuisine_id}', 'BlurbCategoryController@destroy');

    /*
    |--------------------------------------------------------------------------
    | Blurb Reports Route
    |--------------------------------------------------------------------------
     */
    Route::get('blurb-reports', 'BlurbReportController@index');
    Route::delete('blurb-reports/{blurb_report_id}', 'BlurbReportController@destroy');
    Route::get('blurb-reports/notify/{blurb_report_id}', 'BlurbReportController@notify');

    /*
    |--------------------------------------------------------------------------
    | Logout Route
    |--------------------------------------------------------------------------
     */
    Route::get('logout', 'Auth\AuthController@logout');
});
