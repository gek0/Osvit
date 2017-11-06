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
	Route::get('admin', function(){
		return Redirect::to('admin/korisnici');
	});

	Route::group(['prefix' => 'admin'], function() {
		Route::get('naslovnica', ['as' => 'admin-page-home', 'uses' => 'AdminController@showPageHome']);
		Route::post('naslovnica-izmjena', ['as' => 'admin-cover-editPOST', 'uses' => 'AdminController@updateCover']);
		Route::get('naslovnica-brisanje-slike', ['as' => 'admin-cover-image-delete', 'uses' => 'AdminController@deleteCoverImage']);
		Route::post('ukratko-izmjena', ['as' => 'admin-features-editPOST', 'uses' => 'AdminController@updateFeatures']);
		Route::post('info-izmjena', ['as' => 'admin-fun-facts-editPOST', 'uses' => 'AdminController@updateFunFacts']);
		Route::post('o-nama-izmjena', ['as' => 'admin-about-us-editPOST', 'uses' => 'AdminController@updateAboutUs']);

		Route::post('dvorane', ['as' => 'admin-locationsPOST', 'uses' => 'AdminController@addLocation']);
		Route::get('dvorane', ['as' => 'admin-locations', 'uses' => 'AdminController@showLocations']);
		Route::post('dvorane-izmjena', ['as' => 'admin-locations-editPOST', 'uses' => 'AdminController@updateLocation']);
		Route::get('dvorane/izmjena/{id}', ['as' => 'admin-locations-edit', 'uses' => 'AdminController@showUpdateLocation'])->where(['id' => '[0-9]+']);
		Route::get('dvorane-brisanje/{id}', ['as' => 'admin-locations-delete', 'uses' => 'AdminController@deleteLocation'])->where(['id' => '[0-9]+']);

		Route::post('video-galerija', ['as' => 'admin-video-galleryPOST', 'uses' => 'AdminController@updateVideoGallery']);
		Route::get('video-galerija', ['as' => 'admin-video-gallery', 'uses' => 'AdminController@showVideoGallery']);
		Route::get('video-galerija-brisanje', ['as' => 'admin-video-gallery-delete', 'uses' => 'AdminController@deleteVideoGalleryUrl']);

		Route::post('galerija', ['as' => 'admin-image-galleryPOST', 'uses' => 'AdminController@updateImageGallery']);
		Route::get('galerija', ['as' => 'admin-image-gallery', 'uses' => 'AdminController@showImageGallery']);
		Route::get('galerija-brisanje-slike/{id}', ['as' => 'admin-image-gallery-image-delete', 'uses' => 'AdminController@deleteImageGalleryImage']);

		Route::post('korisnici', ['as' => 'admin-usersPOST', 'uses' => 'AdminController@addUser']);
		Route::get('korisnici', ['as' => 'admin-users', 'uses' => 'AdminController@showUsers']);
		Route::post('korisnici-izmjena', ['as' => 'admin-users-editPOST', 'uses' => 'AdminController@updateUser']);
		Route::get('korisnici/izmjena/{id}', ['as' => 'admin-users-edit', 'uses' => 'AdminController@showUpdateUser'])->where(['id' => '[0-9]+']);
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
Route::get('galerija', ['as' => 'image-gallery', 'uses' => 'PublicController@showImageGallery']);
Route::post('kontakt', ['as' => 'contactPOST', 'uses' => 'PublicController@sendMail']);
Route::get('js-map-generator/{id}', ['as' => 'generate-js-map', 'uses' => 'PublicController@generateMap']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);