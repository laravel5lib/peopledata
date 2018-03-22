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


Auth::routes();
Route::get('/img/{path}', 'ImageController@show')->where('path', '.*');

Route::get('/', 'HomeController@index')->name('home');
Route::get('terms', 'HomeController@terms')->name('terms');
Route::resource('members', 'MemberController');
Route::get('members/add/{id}', 'MemberController@add');
Route::post('members/{member}/addimage', 'MemberController@addimage');
Route::get('members/updateinfo/{id}', 'MemberController@updateinfo')->name('members.updateinfo')->middleware('signed');
