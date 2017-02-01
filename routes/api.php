<?php

use Illuminate\Http\Request;

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

Route::post('stories/begin', 'StoryController@begin');
Route::post('stories/join', 'StoryController@join');
Route::resource('stories', 'StoryController');
Route::resource('writers', 'StoryWriterController');
Route::resource('words', 'WordController');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
