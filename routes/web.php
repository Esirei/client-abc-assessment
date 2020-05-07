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

Route::get('/', function () {
    $amount = request('amount', 0);
    $currency_id = request('currency', '');
    $state_id = request('state', '');
    $rates = [];
    if ($amount) {
        $rates = Rate::with(['user.state', 'currency'])->whereHas('currency', function (Builder $query) use ($currency_id) {
            $query->where('id', $currency_id);
        })->whereHas('user.state', function (Builder $query) use ($state_id) {
            if ($state_id) {
                $query->where('id', $state_id);
            }
        })->orderBy('rate')->get();
    }
    return view('welcome')->with(compact('rates', 'amount', 'currency_id', 'state_id'));
})->name('welcome');

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
