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

Route::get('/profile', 'ShowProfile');

Route::get('/theme/new', function() {
	return view('newTheme');
});
Route::post('/theme/new', 'CreateNewTheme');

Route::get('/theme/{id}/sections', function() {
	return view('sections');
});

/**
 * Todo refactor
 */
Route::get('/fields/{id}', 'CustomizerFieldsController@showFields');
Route::post('/fields/{id}/create', 'CustomizerFieldsController@create');