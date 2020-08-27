<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Generate UUID
Route::get('/uuid/generate', 'UuidGenerateController@generate_uuid')->name('generate.uuid');

// Notes
Route::get('/notes/all', 'NoteController@index')->name('all');
Route::get('/notes/fetch_completed', 'NoteController@fetch_completed')->name('fetch_completed');
Route::get('/notes/fetch_pending', 'NoteController@fetch_pending')->name('fetch_pending');
Route::post('/notes/create', 'NoteController@store')->name('create');
Route::get('/notes/{note}', 'NoteController@show')->name('show');
Route::patch('/notes/{note}/update', 'NoteController@update')->name('update');
Route::delete('/notes/{note}/delete', 'NoteController@destroy')->name('delete');
