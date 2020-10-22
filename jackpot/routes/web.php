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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('optimize', 'ClientController@optimize');

Route::get('cache-flush', 'ClientController@cacheFlush')->name('cache.flush');

Route::group(['prefix' => _config('admin_dir'), 'as' => 'admin.', 'middleware' => 'locale'], function () {

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::get('/login', 'AuthController@showLogin')->name('login')->middleware('guest');
        Route::post('/login', 'AuthController@login')->middleware('guest');
        Route::post('/logout', 'AuthController@logout')->name('logout')->middleware('check_auth');
        Route::get('/profile', 'AuthController@profile')->name('profile')->middleware('check_auth');
        Route::post('/profile', 'AuthController@updateProfile')->name('update_profile')->middleware('check_auth');
    });

    Route::group(['middleware' => 'check_auth'], function () {
        // Rules : dashboard-index
        Route::resource('dashboard', 'DashboardController');
        // Rules : user-index , user-create , user-store , user-show , user-edit , user-update , user-destroy
        Route::resource('users', 'UserController');
        // Rules : setting-index , setting-create , setting-store , setting-show , setting-edit , setting-update , setting-destroy
        Route::resource('settings', 'SettingController')->except(['update']);
        Route::put('settings', 'SettingController@update')->name('settings.update');
        // Rules : game-index , game-create , game-store , game-show , game-edit , game-update , game-destroy
        Route::resource('games', 'GameController');
        // Rules : group-index , group-create , group-store , group-show , group-edit , group-update , group-destroy
        Route::resource('groups', 'GroupController');
        // Rules : ticket-index , ticket-create , ticket-store , ticket-show , ticket-edit , ticket-update , ticket-destroy
        Route::resource('tickets', 'TicketController');
        // Rules : lottery-index , lottery-create , lottery-store , lottery-show , lottery-edit , lottery-update , lottery-destroy
        Route::resource('lotteries', 'LotteryController');
        // Pages
        Route::resource('pages', 'PageController');
        // Contacts
        Route::resource('contacts', 'ContactController');
        // Meta Box
        Route::resource('metabox', 'MetaBoxController');
        // FAQ
        Route::resource('faqs', 'FAQController');
        // Request withdraw
        Route::resource('requests','RequestController');

        Route::put('requests-update-mode','RequestController@updateMode')->name('requests.update-mode');

        Route::put('update-status/{id}','RequestController@updateStatus')->where('id','[0-9]+')->name('requests.update-status');

        Route::get('mail','MailController@index')->name('mail.index');
        Route::put('mail','MailController@update')->name('mail.update');
    });
});

Route::get('/', 'Client\HomeController@index')->name("client.home.index")->middleware('redirect.dashboard');
Route::get('/token', 'Client\HomeController@token')->name("client.home.token")->middleware('redirect.dashboard');
Route::get('/affiliate', 'Client\HomeController@affiliate')->name("client.home.affiliate")->middleware('redirect.dashboard');
Route::get('/how-to-play', 'Client\HomeController@howToPlay')->name("client.home.how-to-play")->middleware('redirect.dashboard');
Route::get('/top', 'Client\HomeController@top')->name("client.home.top")->middleware('redirect.dashboard');
Route::get('/roadmap', 'Client\HomeController@roadmap')->name("client.home.roadmap")->middleware('redirect.dashboard');
Route::get('/term', 'Client\HomeController@term')->name("client.home.term")->middleware('redirect.dashboard');
Route::get('/regulation', 'Client\HomeController@regulation')->name("client.home.regulation")->middleware('redirect.dashboard');
Route::get('/dashboard', 'Client\DashboardController@index')->name("client.dashboard.index")->middleware("auth.client");
Route::get('/tickets', 'Client\DashboardController@ticket')->name("client.dashboard.ticket")->middleware("auth.client");
Route::get('/lottery-history', 'Client\DashboardController@lotteryHistory')->name("client.dashboard.lottery")->middleware("auth.client");
Route::get('/user/withdraw', 'Client\UserController@withdraw')->name("client.user.withdraw")->middleware("auth.client");
Route::post('/user/withdraw', 'Client\UserController@withdrawPost')->name("client.user.post-withdraw")->middleware("auth.client");
Route::get('/user/wallet', 'Client\UserController@myRequest')->name("client.user.myRequest")->middleware("auth.client");
Route::get('/user/network', 'Client\UserController@myCommission')->name("client.user.myCommission")->middleware("auth.client");
Route::put('/user/update-language', 'Client\UserController@updateLanguage')->name("client.user.update-language")->middleware("auth.client");
Route::get('/user/balance', 'Client\UserController@getBalance')->name("client.user.balance")->middleware("auth.client"); //
Route::get('/faq', 'Client\UserController@faq')->name("client.user.faq")->middleware("auth.client"); //
Route::put('/ticket/seen-congratulation','Client\TicketController@ticketSeenCongratulation')->name("client.ticket.ticket-seen-congratulation")->middleware("auth.client"); //
Route::post('/subscribe', 'Client\HomeController@Subscribe')->name("client.dashboard.subscribe")->middleware('redirect.dashboard');

Route::get('/login', 'Client\UserController@getLogin')->name("client.user.get-login");
Route::get('/callback', 'Client\UserController@callback')->name('client.user.callback');
Route::post('/login', 'Client\UserController@postLogin')->name("client.user.post-login");
Route::get('/logout', 'Client\UserController@logout')->name("client.user.logout-callback");
Route::post('/logout', 'Client\UserController@logout')->name("client.user.logout")->middleware("auth.client");
Route::group(['prefix' => 'game'], function () {
    Route::post('/buy', 'Client\GameController@buyTicket')->name("client.game.buy")->middleware("auth.client");;
    Route::get('/rules', 'Client\GameController@rules')->name("client.game.rule")->middleware("auth.client");;
    Route::get('/buy-success', 'Client\GameController@buySuccess')->name("client.game.buy-success")->middleware("auth.client");;
    Route::get('/{game_code?}', 'Client\GameController@index')->name("client.game.index")->middleware("auth.client");
    Route::get('/rost/{game_code?}', 'Client\GameController@rost')->name("client.game.rost")->middleware("auth.client");;
});



//Route::get('/set-session/{id?}','Client\UserController@setSession');


//Route::get('/t-m-d-r', 'Client\MailController@index')->name("client.home.index");
