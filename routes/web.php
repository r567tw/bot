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

Route::get('test', function () {
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
Route::get('chat-room', 'ChatRoomController@chatroom');
Route::get('exchange', 'ExchangeController@exchange')->name('exchange');
Route::get('weather', 'WeatherController@weather')->name('weather');
Route::get('line/test', 'LineController@notify');

Route::get('CoVid19', 'CoVid19Controller@index')->name('CoVid19.index');
Route::get('CoVid19/area', 'CoVid19Controller@getResultByArea')->name('CoVid19.area');
Route::get('CoVid19/age', 'CoVid19Controller@getResultByAge')->name('CoVid19.age');
Route::get('CoVid19/gender', 'CoVid19Controller@getResultByGender')->name('CoVid19.gender');
Route::get('CoVid19/foreign', 'CoVid19Controller@getResultByForeign')->name('CoVid19.gender');
Route::get('CoVid19/international', 'CoVid19Controller@getInternational')->name('CoVid19.international');
