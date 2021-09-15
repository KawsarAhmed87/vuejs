<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/{xyz}', 'HomeController@index')->where('path', '.*');


Route::post('category-create', 'Admin\CategoryController@store')->name('category.create');
Route::get('category-list', 'Admin\CategoryController@index');
Route::get('category-delete/{id}', 'Admin\CategoryController@destroy');
Route::get('category-show/{slug}', 'Admin\CategoryController@show');
Route::post('category-update/{slug}', 'Admin\CategoryController@update');


Route::post('post-create', 'Admin\PostController@store');
Route::get('post-list', 'Admin\PostController@index');
Route::get('post-delete/{id}', 'Admin\PostController@destroy');
Route::get('post-show/{slug}', 'Admin\PostController@show');
Route::post('post-update/{slug}', 'Admin\PostController@update');