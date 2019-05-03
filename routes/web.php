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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'MainPage@show');

Route::get('/appointments', 'Appointments@show');
Route::get('/appointments/car-class-list', 'Appointments@getCarClassList');
Route::get('/appointments/price-list/car-class/{id}', 'Appointments@getPrice');
Route::get('/appointments/price-list/', 'Appointments@getPriceList');
Route::get('/appointments/date-list', 'Appointments@getDateList');

Route::get('/work_examples', 'WorkExamples@show');

Route::get('/about_us', 'AboutUs@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
