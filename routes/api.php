<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('subjects', 'Api\SubjectController');
Route::get('subject/messages/{id}', 'Api\SubjectController@getAllMessage')->name('subject.all-message');
// Route::post('uploadImg', 'Api\contacts@uploadImg');
// Route::post('getSubjectByNameStatus', 'Api\contacts@getSubjectByNameStatus');
// Route::post('getSubjectByStatus', 'Api\contacts@getSubjectByStatus');
Route::post('fill-data', 'Api\SubjectController@fillData')->name('fillData');
Route::post('store-message', 'Api\SubjectController@storeMessage')->name('message.store-message');
