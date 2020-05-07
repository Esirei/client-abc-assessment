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

Route::get('/test', function () {
    return Rate::with(['user.state', 'currency'])->whereHas('currency', function (Builder $query) {
        $query->where('name', 'U.S. Dollar');
    })->whereHas('user.state', function (Builder $query) {
        $query->whereIn('name', ['Delta', 'Edo']);
    })->get();
    return User::query()->with(['orders', 'rates.currency', 'state'])->get();
});
