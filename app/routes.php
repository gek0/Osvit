<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * admin area
 */
Route::group(['before' => 'auth'], function() {
	Route::group(['prefix' => 'admin'], function() {
		Route::get('/', ['as' => 'admin-home', 'uses' => 'AdminController@showHome']);

		Route::post('korisnici', ['as' => 'admin-usersPOST', 'uses' => 'AdminController@addUser']);
		Route::get('korisnici', ['as' => 'admin-users', 'uses' => 'AdminController@showUsers']);
		Route::post('korisnici-izmjena', ['as' => 'admin-users-editPOST', 'uses' => 'AdminController@updateUser']);
		Route::get('korisnici-izmjena/{id}', ['as' => 'admin-users-edit', 'uses' => 'AdminController@showUpdateUser'])->where(['id' => '[0-9]+']);
		Route::get('korisnici-brisanje/{id}', ['as' => 'admin-users-delete', 'uses' => 'AdminController@deleteUser'])->where(['id' => '[0-9]+']);
	});
});

/**
 * logout from admin area
 */
Route::get('odjava', function(){
	Auth::logout();
	return Redirect::to('/');
});

/**
 * public area
 */
Route::post('prijava', ['as' => 'loginPost', 'uses' => 'LoginController@checkLogin']);
Route::get('prijava', ['as' => 'login', 'uses' => 'LoginController@showLogin']);

Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);