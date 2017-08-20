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

// Blog Routes
Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])
			->where('slug', '[\w\d\-\_]+');
Route::get('blog', ['as' => 'blog.index', 'uses' => 'BlogController@getIndex']);

// Contact Route
Route::get('contact', 'PagesController@getContact')->name('contact.index');
Route::post('contact', 'PagesController@postContact')->name('contact.post');

// About Us Route
Route::get('about', 'PagesController@getAbout');

// Index/Root
Route::get('/', 'PagesController@getIndex');

// Admin Blog Control Panel for Blog Posts
Route::resource('posts', 'PostController');

// Admin Categories Control Panel
Route::resource('categories', 'CategoryController', ['except' => 'create']);

// Tags Controller
Route::resource('tags', 'TagController', ['except' => 'create']);

// Login Routes for Users
Auth::routes();

// User Dashboard
Route::get('/home', 'HomeController@index')->name('user.dashboard');

// Admin Routes
Route::prefix('admin')->group(function() {

	// Admin Login Routes
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	// Admin Index/Root
	Route::get('/', 'AdminController@index')->name('admin.dashboard');

	// Admin Logout
	Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	// Admin Password Reset Routes
	Route::post('/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	Route::get('/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	Route::post('/password/reset', 'Auth\AdminResetPasswordController@reset');
	Route::get('/password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

});
