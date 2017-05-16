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

Route::group(['middleware' => 'web'], function(){


    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@postLogin')->name('login');
    Route::get('logout', 'Auth\LoginController@getLogout')->name('logout');

    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');


    Route::group([], function() {
        // Admin Routes
        Route::get('user', 'UserManagementController@index')->name('usermanagement');
        Route::post('user', 'UserManagementController@store')->name('usermanagement');
        Route::delete('user/{id}', 'UserManagementController@destroy')->name('user.destroy');

        Route::get('book', 'BookManagementController@index')->name('bookmanagement');
        Route::post('book', 'BookManagementController@store')->name('bookmanagement');
        Route::delete('book/{id}', 'BookManagementController@destroy')->name('book.destroy');

        Route::get('loan', 'LoanManagementController@index')->name('loanmanagement');
    });

    Route::group([], function() {
        //User Routes
        Route::post('notification', 'NotificationController@store')->name('notification.request');

        Route::get('/index', 'HomeController@index')->name('index');
    });

});

