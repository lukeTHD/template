<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PagesController@index');


// Demo routes
Route::get('/datatables', 'PagesController@datatables');
Route::get('/ktdatatables', 'PagesController@ktDatatables');
Route::get('/select2', 'PagesController@select2');
Route::get('/icons/custom-icons', 'PagesController@customIcons');
Route::get('/icons/flaticon', 'PagesController@flaticon');
Route::get('/icons/fontawesome', 'PagesController@fontawesome');
Route::get('/icons/lineawesome', 'PagesController@lineawesome');
Route::get('/icons/socicons', 'PagesController@socicons');
Route::get('/icons/svg', 'PagesController@svg');

// Quick search dummy route to display html elements in search dropdown (header search)
Route::get('/quick-search', 'PagesController@quickSearch')->name('quick-search');

//
Route::get('/list_template', 'ListTemplateController@list_template');


Route::get('/listcontact', function () {
    $page_title = 'List Contact';
    $page_description = 'This is list contact page';
    return  view('contacts.HomeContact', [
        "page_title" => $page_title,
        "page_description" => $page_description,
    ]);
});

Route::get('/home', function () {
    return  view('contacts.home');
});


Route::get('/private', function () {
    return  view('contacts.private');
});


Route::get('/testapi', function () {
    return  view('testapi');
});
