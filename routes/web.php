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

Route::get('/', [
    'as' => 'welcome',
    'uses' => 'HomeController@index'
]);

Route::post('/reservation', [
    'as' => 'reservation.reserve',
    'uses' => 'ReservationController@reserve'
]);

Route::post('/contact', [
    'as' => 'contact.send',
    'uses' => 'ContactController@sendMessage'
]);

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'namespace' => 'admin'], function (){

    Route::get('dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'DashboardController@index'
    ]);

    Route::get('reservation', [
        'as' => 'reservation.index',
        'uses' => 'ReservationController@index'
    ]);

    Route::delete('reservation/{id}', [
        'as' => 'reservation.destroy',
        'uses' => 'ReservationController@destroyReservation'
    ]);

    Route::post('reservation/{id}', [
        'as' => 'reservation.status',
        'uses' => 'ReservationController@status'
    ]);


    Route::resource('slider', 'SliderController');
    Route::resource('category', 'CategoryController');
    Route::resource('item', 'ItemController');
});
