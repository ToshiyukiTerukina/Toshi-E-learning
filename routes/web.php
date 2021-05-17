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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/{id}', 'UserController@index')->name('user.index');
Route::get('/user/{id}/edit-profile', 'UserController@edit')->name('user.edit');
Route::post('/user/{id}/edit-profile', 'UserController@update');

Route::get('/users', 'UserController@showAllUsers')->name('users.list');

Route::post('/follow/{id}', 'UserController@follow')->name('follow');
Route::post('/unfollow{id}', 'UserController@unfollow')->name('unfollow');

Route::get('/user/{id}/following', 'UserController@showFollowingList')->name('following.list');
Route::get('/user/{id}/follower', 'UserController@showFollowerList')->name('follower.list');

//Admin
Route::get('/admin/dashboard/categories', 'AdminCategoryController@index')->name('admin.dashboard');

Route::get('/admin/dashboard/categories/{id}/edit', 'AdminCategoryController@edit')->name('admin.category.edit');
Route::post('/admin/dashboard/categories/{id}/edit', 'AdminCategoryController@update');

Route::get('/admin/dashboard/categories/create', 'AdminCategoryController@showCreateForm')->name('admin.category.create');
Route::post('/admin/dashboard/categories/create', 'AdminCategoryController@create');

Route::post('/admin/dashboard/categories/{id}/delete', 'AdminCategoryController@delete')->name('admin.category.delete');


//Admin users
Route::get('/admin/dashboard/users', 'AdminUserController@indes')->name('admin.dashboard.users');
