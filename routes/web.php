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
Route::get('changepass','UserController@changepass')->name('changepass')->middleware('CheckPermission:');
Route::post('changepass','UserController@changepasssave')->middleware('CheckPermission:');

Route::get('ratiomgmt','NilaiController@ratiomgmt')->name('ratiomgmt')->middleware('CheckPermission:');
Route::post('ratiomgmt','NilaiController@ratiomgmtsave')->middleware('CheckPermission:');

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

    Route::get('listspv','NilaiController@listspv')->name('nilai.listspv')->middleware('CheckPermission:SPV');
    Route::get('viewspv/{id}','NilaiController@viewspv')->name('nilai.viewspv')->middleware('CheckPermission:SPV');
    
    Route::get('listdepthead','NilaiController@listdepthead')->name('nilai.listdepthead')->middleware('CheckPermission:Dept Head');
    Route::get('viewdepthead/{id}','NilaiController@viewdepthead')->name('nilai.viewdepthead')->middleware('CheckPermission:Dept Head');
    
    Route::get('listcomitee','NilaiController@listcomitee')->name('nilai.listcomitee')->middleware('CheckPermission:Comitee');
    Route::get('viewcomitee/{id}','NilaiController@viewcomitee')->name('nilai.viewcomitee')->middleware('CheckPermission:Comitee');

    Route::post('save','NilaiController@save')->name('nilai.save')->middleware('CheckPermission:SPV|Dept Head|Comitee');

});

Route::group(['prefix' => 'user', 'middleware' => 'web'], function () {

    Route::get('list','UserController@list')->name('user.list')->middleware('CheckPermission:User Management');

    Route::get('new','UserController@new')->name('user.new')->middleware('CheckPermission:User Management');
    Route::post('new','UserController@save')->middleware('CheckPermission:User Management');
    
    Route::get('edit/{id}','UserController@edit')->name('user.edit')->middleware('CheckPermission:User Management');
    Route::post('update','UserController@update')->name('user.update')->middleware('CheckPermission:User Management');


});