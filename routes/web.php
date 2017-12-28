<?php


Route::view('/', 'welcome');
Route::view('/howto', 'howto');

Auth::routes();

Route::get('/logout', function () {
    \Illuminate\Support\Facades\Auth::logout();

    return redirect('/');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/remindme', 'WelcomePageEmailSignupController@signup');

Route::get('/start', 'ShowStartPage');

Route::get('/fieldtypes', 'GetFieldTypes');

/**
 * Themes
 */
Route::resource('theme', 'ThemeController');
Route::get('theme/{themeId}/download', 'DownloadThemeFiles');

/**
 * Sections
 */
Route::prefix('/theme/{themeId}')->group(function () {
    Route::get('sections/{sectionId}/download', 'DownloadSectionFile');
    Route::resource('sections', 'SectionController');
});


/**
 * Fields
 */
Route::prefix('/theme/{themeId}/sections/{sectionId}')->group(function () {
    Route::resource('fields', 'FieldsController');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
//Route::get( 'email', function () {
//	return new \App\Mail\LaunchEmail();
//} );