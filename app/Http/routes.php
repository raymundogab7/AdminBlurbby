<?php

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
    Route::get('dashboard/getLastSevenDays/{field}', 'DashboardController@getLastSevenDays');

    /*
    |--------------------------------------------------------------------------
    | Featured Section Route
    |--------------------------------------------------------------------------
     */
    Route::resource('featured-section', 'FeaturedSectionController', ['except' => ['show']]);
    Route::get('featured-section/move/{merchant_id}/{featured_section_id}/{direction}', 'FeaturedSectionController@move');

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

    /*
    |--------------------------------------------------------------------------
    | Merchant Route
    |--------------------------------------------------------------------------
     */
    Route::resource('merchants', 'MerchantController');
    Route::put('merchant/withdraw/{merchant_id}', 'MerchantControllerr@withdraw');
    Route::put('merchant/updateStatus/{merchant_id}', 'MerchantControllerr@updateStatus');
    Route::put('merchant/updateCamRead/{merchant_id}', 'MerchantControllerr@updateCamRead');
    Route::post('merchant/markAllAsRead', 'MerchantControllerr@markAllAsRead');
    Route::post('merchant/duplicate/{merchant_id}', 'MerchantControllerr@duplicate');

    Route::put('merchant/updateNotifNotToRead/{notification_id}', 'NotificationsController@updateNotifNotToRead');
    Route::put('merchant/updateNotifToRead/{notification_id}', 'NotificationsController@updateNotifToRead');
    Route::post('merchant/report/generate', 'MerchantControllerr@generateReport');
    Route::post('merchant/report/generate/{merchant_id}', 'MerchantControllerr@generateCampaignReport');

    Route::get('merchant/getLastSevenDays/{merchant_id}/{field}', 'MerchantControllerr@getLastSevenDays');

    Route::get('merchant/search/{search_word}/{search_type}', 'MerchantControllerr@getSearchResult');
    Route::get('merchant/search/show/{search_word}/{search_type}', 'MerchantControllerr@getSearchResult');
});

