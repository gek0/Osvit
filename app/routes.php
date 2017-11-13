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
		return Redirect::to(route('admin-page-home'));
	});

	Route::group(['prefix' => 'admin'], function() {
		Route::get('naslovnica', ['as' => 'admin-page-home', 'uses' => 'AdminController@showPageHome']);
		Route::post('naslovnica-izmjena', ['as' => 'admin-cover-editPOST', 'uses' => 'AdminController@updateCover']);
		Route::get('naslovnica-brisanje-slike', ['as' => 'admin-cover-image-delete', 'uses' => 'AdminController@deleteCoverImage']);
		Route::post('ukratko-izmjena', ['as' => 'admin-features-editPOST', 'uses' => 'AdminController@updateFeatures']);
		Route::post('info-izmjena', ['as' => 'admin-fun-facts-editPOST', 'uses' => 'AdminController@updateFunFacts']);
		Route::post('o-nama-izmjena', ['as' => 'admin-about-us-editPOST', 'uses' => 'AdminController@updateAboutUs']);

		Route::get('obavijesti', ['as' => 'admin-news', 'uses' => 'NewsController@showNews']);
		Route::get('obavijesti/nova', ['as' => 'admin-news-add', 'uses' => 'NewsController@showNewNewsForm']);
		Route::post('obavijesti/nova', ['as' => 'admin-news-addPOST', 'uses' => 'NewsController@addNewNews']);
		Route::get('obavijesti/pregled/{slug}', ['as' => 'admin-news-show', 'uses' => 'NewsController@showIndividualNews'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
		Route::get('obavijesti/izmjena/{slug}', ['as' => 'admin-news-edit', 'uses' => 'NewsController@showNewsEditForm'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
		Route::post('obavijesti/izmjena/{slug}', ['as' => 'admin-news-editPOST', 'uses' => 'NewsController@updateNews'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
		Route::get('obavijesti/brisanje/{slug}', ['as' => 'admin-news-delete', 'uses' => 'NewsController@deleteNews'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
		Route::get('obavijesti/brisanje-slike-obavijesti/{id}', ['as' => 'admin-news-gallery-image-delete', 'uses' => 'NewsController@deleteNewsGalleryImage'])->where(['id' => '[0-9]+']);

		Route::post('dvorane', ['as' => 'admin-locationsPOST', 'uses' => 'LocationController@addLocation']);
		Route::get('dvorane', ['as' => 'admin-locations', 'uses' => 'LocationController@showLocations']);
		Route::post('dvorane-izmjena', ['as' => 'admin-locations-editPOST', 'uses' => 'LocationController@updateLocation']);
		Route::get('dvorane/izmjena/{id}', ['as' => 'admin-locations-edit', 'uses' => 'LocationController@showUpdateLocation'])->where(['id' => '[0-9]+']);
		Route::get('dvorane-brisanje/{id}', ['as' => 'admin-locations-delete', 'uses' => 'LocationController@deleteLocation'])->where(['id' => '[0-9]+']);

		Route::post('video-galerija', ['as' => 'admin-video-galleryPOST', 'uses' => 'GalleryController@updateVideoGallery']);
		Route::get('video-galerija', ['as' => 'admin-video-gallery', 'uses' => 'GalleryController@showVideoGallery']);
		Route::get('video-galerija-brisanje', ['as' => 'admin-video-gallery-delete', 'uses' => 'GalleryController@deleteVideoGalleryUrl']);

		Route::post('galerija', ['as' => 'admin-image-galleryPOST', 'uses' => 'GalleryController@updateImageGallery']);
		Route::get('galerija', ['as' => 'admin-image-gallery', 'uses' => 'GalleryController@showImageGallery']);
		Route::get('galerija-brisanje-slike/{id}', ['as' => 'admin-image-gallery-image-delete', 'uses' => 'GalleryController@deleteImageGalleryImage'])->where(['id' => '[0-9]+']);

		Route::post('korisnici', ['as' => 'admin-usersPOST', 'uses' => 'UserController@addUser']);
		Route::get('korisnici', ['as' => 'admin-users', 'uses' => 'UserController@showUsers']);
		Route::post('korisnici-izmjena', ['as' => 'admin-users-editPOST', 'uses' => 'UserController@updateUser']);
		Route::get('korisnici/izmjena/{id}', ['as' => 'admin-users-edit', 'uses' => 'UserController@showUpdateUser'])->where(['id' => '[0-9]+']);
		Route::get('korisnici-brisanje/{id}', ['as' => 'admin-users-delete', 'uses' => 'UserController@deleteUser'])->where(['id' => '[0-9]+']);
	});
});

/**
 * logout from admin area
 */
Route::get('odjava', function(){
	Auth::logout();
	return Redirect::to(route('home'));
});

/**
 * public area
 */
Route::post('prijava', ['as' => 'loginPOST', 'uses' => 'LoginController@checkLogin']);
Route::get('prijava', ['as' => 'login', 'uses' => 'LoginController@showLogin']);
Route::get('galerija', ['as' => 'image-gallery', 'uses' => 'PublicController@showImageGallery']);
Route::get('obavijesti', ['as' => 'news', 'uses' => 'PublicController@showNews']);
Route::get('obavijesti/sortirano', ['as' => 'news-sort', 'uses' => 'PublicController@showFilteredSortedNews']);
Route::get('obavijesti/pregled/{slug}', ['as' => 'news-show', 'uses' => 'PublicController@showIndividualNews'])->where(['slug' => '[\w\-šðèæžŠÐÈÆŽ]+']);
Route::get('rss', ['as' => 'rss', 'uses' => 'PublicController@getRss']);
Route::post('kontakt', ['as' => 'contactPOST', 'uses' => 'PublicController@sendMail']);
Route::get('js-map-generator/{id}', ['as' => 'generate-js-map', 'uses' => 'PublicController@generateMap']);
Route::get('/', ['as' => 'home', 'uses' => 'PublicController@showHome']);