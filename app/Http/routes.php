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
});