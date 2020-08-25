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

// ...
Route::get('/message/question', 'Web\MessageController@question');
Route::get('/message/course', 'Web\MessageController@course');
Route::post('/message', 'Web\MessageController@store');
Route::get('/{slug}', 'Web\FallbackController@show')->where('slug', '.*');
