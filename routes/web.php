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

Route::get('/', function () {
    return view('index');
});

Route::prefix('user')->group(function() {
    Route::get('/', 'StudentController@index')->name('user');
    Route::post('/store', 'StudentController@store')->name('user.store');
    Route::put('/update/{id}', 'StudentController@update')->name('user.update');
    Route::delete('/delete/{id}', 'StudentController@destroy')->name('user.delete');
});