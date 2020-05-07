<?php

use App\Currency;
use App\Rate;
use App\State;
use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'WelcomeController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
    Route::get('/', 'OrderController@store')->name('create');
    Route::post('/expected-delivery', 'OrderController@expectedDelivery')->name('expected-delivery');
});
