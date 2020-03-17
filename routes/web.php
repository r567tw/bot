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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('test',function(){
    return 'This is test page2';
});

Route::post('/webhook', 'WebhookController@index');

Route::resource('users', 'UserDashBoardController');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')
    ->name('logs')
    ->middleware(['developer']);

Route::resource('posts', 'PostController');
Route::get('chat', 'ChatRoomController@index')->name('chatroom');
Route::post('chat', 'ChatRoomController@store')->name('chat');
Route::resource('chats', 'ChatController');
Route::get('exchange','ExchangeController@exchange')->name('exchange');
Route::get('weather','WeatherController@weather')->name('weather');
