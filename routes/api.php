<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::Pattern('id', '[0-9]+');


Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {

    Route::get('governorates', 'GovernorateController@governorates');
    Route::get('cities', 'CityController@cities');
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('settings', 'SettingController@settings');
    Route::get('BloodType', 'BloodTypeController@bloodType');
    Route::get('categories', 'CategoryController@categories');
    Route::post('reset-password', 'AuthController@ResetPassword');
    Route::post('new-password', 'AuthController@newPassword');
    Route::post('removeToken', 'AuthController@removeToken');



    Route::group(['middleware' => 'auth:api'], function () {

    Route::post('AddDonationRequests','DonationRequestController@donationRequestCreate');
    Route::get('posts', 'PostController@posts');
    Route::get('PostsWithCategory','PostController@AllPostsWithCategory');
    Route::get('post/{id}','PostController@SinglePost');
    Route::post('contacts', 'ContactController@contacts');
    Route::get('notification', 'NotificationController@notifications');
    Route::post('registerToken', 'AuthController@registerToken');
    Route::post('update', 'EditProfileController@update');
    Route::get('AllDonationRequest', 'DonationRequestController@AllDonationRequest');
    Route::get('DonationRequest/{id}', 'DonationRequestController@DonationRequest');
    Route::post('sitingNotification','DonationRequestController@notificationsSettings');

    });

});






