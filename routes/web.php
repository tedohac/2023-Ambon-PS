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


Route::get('/','MainController@index')->name('main')->middleware('CheckPermission:');

Route::group(['middleware' => 'web'], function () {
    
    Route::get('/login', 'AuthController@form')->name('login');
    Route::post('/login', 'AuthController@process');

    Route::get('/logout', 'AuthController@logout')->name('logout');
});

Route::group(['prefix' => 'kip', 'middleware' => 'web'], function () {

    Route::get('listown','KipController@listown')->name('kip.listown')->middleware('CheckPermission:Employee');

    Route::get('new','KipController@new')->name('kip.new')->middleware('CheckPermission:Employee');
    Route::post('new','KipController@save')->middleware('CheckPermission:Employee');
    
    Route::get('edit/{id}','KipController@edit')->name('kip.edit')->middleware('CheckPermission:Employee');
    Route::post('update','KipController@update')->name('kip.update')->middleware('CheckPermission:Employee');
    
    Route::get('view/{id}','KipController@view')->name('kip.view')->middleware('CheckPermission:');
});

Route::group(['prefix' => 'nilai', 'middleware' => 'web'], function () {
    Route::get('listspv','NilaiController@listspv')->name('nilai.listspv')->middleware('CheckPermission:SPV|Dept Head|Comitee');
});
