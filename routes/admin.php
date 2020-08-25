<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/login', 'Admin\AuthController@show')->name('admin.login');
Route::post('/login', 'Admin\AuthController@login');

Route::middleware('auth:admin')->group(function () {
    Route::get('/', 'Admin\HomeController@show')->name('admin.home');
    Route::get('/logout', 'Admin\AuthController@logout');
    Route::get('/help/{id}', 'Admin\HelpController@show');

    Route::get('/me', 'Admin\AuthController@me');
    Route::post('/me', 'Admin\AuthController@updateme');

    Route::get('/content', 'Admin\ContentController@index');
    Route::get('/content/{id}', 'Admin\ContentController@show');
    Route::post('/content/{id}', 'Admin\ContentController@update');
    Route::post('/content', 'Admin\ContentController@create');

    Route::get('/company', 'Admin\CompanyController@show');
    Route::post('/company', 'Admin\CompanyController@update');

    Route::get('/office', 'Admin\OfficeController@index');
    Route::get('/office/{id}', 'Admin\OfficeController@show');
    Route::post('/office/{id}', 'Admin\OfficeController@update');
    Route::post('/office', 'Admin\OfficeController@store');

    Route::get('/admins', 'Admin\AdminController@index');
    Route::get('/admins/{id}', 'Admin\AdminController@show');
    Route::post('/admins/{id}', 'Admin\AdminController@update');
    Route::post('/admins', 'Admin\AdminController@store');

    Route::get('/settings', 'Admin\SettingsController@index');
    Route::post('/settings', 'Admin\SettingsController@update');

    Route::get('/message', 'Admin\MessageController@index');

    Route::get('/modal/new/content', 'Admin\ContentController@new');
    Route::get('/modal/new/company', 'Admin\CompanyController@new');
    Route::get('/modal/new/office', 'Admin\OfficeController@new');
    Route::get('/modal/new/admin', 'Admin\AdminController@new');
    Route::get('/modal/message/{id}', 'Admin\MessageController@show');
});

Route::any('/{slug}', 'Admin\HomeController@fallback')->where('slug', '.*');



