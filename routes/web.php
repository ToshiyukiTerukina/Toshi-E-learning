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

//Admin categories
Route::get('/admin/dashboard/categories', 'AdminCategoryController@index')->name('admin.dashboard');

Route::get('/admin/dashboard/categories/{category_id}/edit', 'AdminCategoryController@edit')->name('admin.category.edit');
Route::post('/admin/dashboard/categories/{category_id}/edit', 'AdminCategoryController@update');

Route::get('/admin/dashboard/categories/create', 'AdminCategoryController@showCreateForm')->name('admin.category.create');
Route::post('/admin/dashboard/categories/create', 'AdminCategoryController@create');

Route::post('/admin/dashboard/categories/{category_id}/delete', 'AdminCategoryController@delete')->name('admin.category.delete');


//Admin users
Route::get('/admin/dashboard/users', 'AdminUserController@index')->name('admin.dashboard.users');

Route::get('/admin/dashboard/users/{id}/edit', 'AdminUserController@edit')->name('admin.user.edit');
Route::post('/admin/dashboard/users/{id}/edit', 'AdminUserController@update');

Route::get('/admin/dashboard/users/create', 'AdminUserController@showCreateForm')->name('admin.user.create');
Route::post('/admin/dashboard/users/create', 'AdminUserController@create');

Route::post('/admin/dashboard/users/{id}/delete', 'AdminUserController@delete')->name('admin.user.delete');

//Admin question
Route::get('/admin/dashboard/categories/{category_id}', 'AdminWordController@index')->name('admin.question.index');

Route::get('/admin/dashboard/categories/{category_id}/question/{question_id}/edit', 'AdminWordController@edit')->name('admin.question.edit');
Route::post('/admin/dashboard/categories/{category_id}/question/{question_id}/edit', 'AdminWordController@update');

Route::get('/admin/dashboard/categories/{category_id}/question/create', 'AdminWordController@showCreateForm')->name('admin.question.create');
Route::post('/admin/dashboard/categories/{category_id}/question/create', 'AdminWordController@create');

Route::post('/admin/dashboard/categories/{category_id}/question/{question_id}/delete', 'AdminWordController@delete')->name('admin.question.delete');

