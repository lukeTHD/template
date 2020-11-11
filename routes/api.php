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

Route::apiResource('getSubject', 'Api\contacts');
Route::get('getContentsByIdTitle/{id}', 'Api\contacts@getContentsByIdTitle');
Route::get('getTitle/{id}', 'Api\contacts@getTitle');
Route::post('uploadImg', 'Api\contacts@uploadImg');
Route::post('getSubjectByNameStatus', 'Api\contacts@getSubjectByNameStatus');
Route::post('getSubjectByStatus', 'Api\contacts@getSubjectByStatus');
Route::post('fillData', 'Api\contacts@fillData');
Route::post('addContent', 'Api\contacts@addContent');
