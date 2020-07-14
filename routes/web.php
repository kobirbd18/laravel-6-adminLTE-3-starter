<?php

use Illuminate\Support\Facades\Route;

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

//Main Domain Access Deny
Route::domain(env('APP_DOMAIN_URL'))->group(function () {
    Route::any('/', function () {
        return view('error.unauthorized');
    });
});

// currently block all user/owner access
// Auth::routes(['register' =>false]);
// Route::get('/home', 'HomeController@index')->name('home');
Route::domain(env('ADMIN_PANEL_SUB_DOMAIN', 'admin') . '.' . env('APP_DOMAIN_URL'))->group(function () {
    Route::get('/home', function () {
        return redirect('/');
    });

    Route::group([
        'namespace' => 'Admin',
        'as' => 'admin.',
    ], function () {
        //Reset Password
        Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.forgot');
        Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::post('password/reset', 'ResetPasswordController@reset');
        Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
        //Login/logout
        Route::get('login', 'AdminLoginController@showLogin')->name('login');
        Route::post('login', 'AdminLoginController@login')->name('login.submit');
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::get('logout', 'AdminLoginController@logout')->name('logout');
        //Change Password
        Route::get('change-password', 'AdminController@changePassword')->name('changePassword');
        Route::post('change-password', 'AdminController@changePasswordStore');
        //Admin Permission Group
        Route::resource('admin-permission-groups', 'AdminPermissionGroupController');
        //Admin
        Route::get('admins/resetPassword/{id}', 'AdminController@resetPassword')->name('admins.resetPassword');
        Route::patch('admins/resetPassword/{id}', 'AdminController@resetPasswordStore')->name('admins.resetPasswordStore');
        Route::resource('admins', 'AdminController');


    });

    //end admin
});
