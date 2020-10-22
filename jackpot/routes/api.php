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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// domain/api

Route::group(['middleware' => 'api', 'namespace' => 'Api', 'as' => 'api.'], function () {
    Route::resource('users', 'UserController')->except(['destroy']);
    Route::delete('/users/{id?}', 'UserController@destroy')->name('users.destroy');
    Route::resource('settings', 'SettingController')->except(['update']);
    Route::put('settings', 'SettingController@update')->name('settings.update');
    Route::resource('games', 'GameController')->except(['destroy']);
    Route::delete('/games/{id?}', 'GameController@destroy')->name('games.destroy');
    Route::resource('groups', 'GroupController');
    Route::resource('roles', 'RoleController');
    Route::resource('tickets', 'TicketController');
    Route::resource('lotteries', 'LotteryController');
    Route::post('/upload-image', 'UploadController@image')->name('upload.image');
    Route::resource('bookings', 'BookingController');
    Route::resource('contacts', 'ContactController');
    Route::resource('requests', 'RequestController');
    Route::get('/credit-activities','CreditController@activities')->name('credit-activities');

    // Begin: Statistic

    Route::group(['prefix' => 'statistic', 'as' => 'statistic.'], function () {
        Route::get('tickets', 'StatisticController@tickets')->name('tickets');
        Route::get('games', 'StatisticController@games')->name('games');
        Route::get('users', 'StatisticController@users')->name('users');
        Route::get('credits', 'StatisticController@credits')->name('credits');
    });

    // End: Statistic
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('logout', 'AuthController@logout')->name('logout');
        Route::post('refresh', 'AuthController@refresh')->name('refresh');
        Route::post('register', 'AuthController@register')->name('register');
        Route::get('me', 'AuthController@me')->name('me');
    });

    // Client statistic

    Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
        Route::get('top-winners', 'StatisticController@topWinners')->name('top_winners');
    });

    Route::group(['prefix' => 'lottery', 'as' => 'lottery.'], function () {
        Route::get('run','LotteryController@run')->name('run');
        Route::get('get','LotteryController@get')->name('get');
        Route::get('update-vaults','LotteryController@updateVaults')->name('update_vaults');
    });

    Route::get('crate','CrateController@crate');
    Route::get('lotteries','LotteryController@list');
    Route::get('lottery/{id}','LotteryController@api')->where(['id' => '[0-9]+']);
    Route::get('commission','CommissionController@index');
    Route::get('commission/{id?}','CommissionController@index')->where(['id' => '[0-9]+']);;
});

//Route::group(["prefix"=>"w","middleware"=>["ipcheck"]],function ()
Route::group(["prefix" => "w", "middleware" => []], function () {
    Route::post("/p", "Api\WalletController@Deposit");
    Route::post("/crate", "Api\WalletController@Crate");
    Route::get('/test-html',"Api\WalletController@testView");
//    Route::get("/test", "Api\WalletController@test");
//    Route::get("/test-reward", "Api\WalletController@testRewardGame");
});
