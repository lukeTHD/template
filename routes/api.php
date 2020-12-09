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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['namespace' => 'Api', 'as' => 'api.'], function(){
    Route::get('tickets', 'TicketController@index')->name('tickets.index');
    Route::get('tickets/update-status/{id}/{status}', 'TicketController@updateStatus')->name('tickets.update-status')->middleware('checkAuth:api');
    Route::post('tickets/update-rows-status', 'TicketController@updateRowsStatus')->name('tickets.update-rows-status')->middleware('checkAuth:api');
    Route::post('tickets/send-ticket', 'TicketController@sendTicket')->name('tickets.send-ticket');
    Route::post('tickets/send-message', 'TicketController@sendMessage')->name('tickets.send-message');
    Route::post('tickets/upload-image', 'TicketController@upLoadFile')->name('tickets.upload-image');
});

