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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/logout', function () {
	\Illuminate\Support\Facades\Auth::logout();
	return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/remindme', 'WelcomePageEmailSignupController@signup');

Route::get('/start', 'ShowStartPage');

/**
 * Themes
 */
Route::resource('theme', 'ThemeController');

/**
 * Sections
 */
Route::prefix('/theme/{id}')->group(function() {
	Route::resource('sections', 'SectionController');
});


/**
 * Fields
 */
Route::prefix('/theme/{themeId}/sections/{sectionId}')->group(function() {
	Route::resource('fields', 'FieldsController');
});