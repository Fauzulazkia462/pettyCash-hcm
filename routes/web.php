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

Route::get('/login', 'LoginController@index')->name('login')->middleware('guest');
Route::post('/login', 'LoginController@authenticate');
Route::post('/logout', 'LoginController@logout');

Route::get('/', 'HomeController@index')->middleware('auth');
Route::get('/input', 'InputController@index')->middleware('auth');
Route::get('/export', 'ExportController@index')->middleware('auth');
Route::post('/insert-data', 'InputController@insert')->middleware('auth');
Route::post('/insert-in-data', 'InputController@insertKredit')->middleware('auth');
Route::post('/export-excel', 'ExportController@exportexcel')->name('exportexcel')->middleware('auth');
Route::post('/export-in-excel', 'ExportController@exportinexcel')->name('exportinexcel')->middleware('auth');
Route::post('/export-all-excel', 'ExportController@exportallexcel')->name('exportallexcel')->middleware('auth');
Route::post('/edit-data', 'HomeController@update')->middleware('auth');
Route::post('/edit-in-data', 'HomeController@updateKredit')->middleware('auth');
Route::post('/delete-data', 'HomeController@delete')->middleware('auth');
Route::post('/delete-in-data', 'HomeController@deleteKredit')->middleware('auth');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
