<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Rate;
use App\State;
use Illuminate\Database\Eloquent\Builder;

class WelcomeController extends Controller
{

    /**
     * Show the application welcome.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currencies = Currency::all();
        $states = State::all();
        $amount = request('amount', '');
        $currency_id = request('currency', '');
        $state_id = request('state', '');
        $rates = [];
        if ($amount) {
            // Get rates where the currency matches selected currency, and seller's state matches selected state.
            $rates = Rate::with(['user.state', 'currency'])->whereHas('currency', function (Builder $query) use ($currency_id) {
                $query->where('id', $currency_id);
            })->whereHas('user.state', function (Builder $query) use ($state_id) {
                if ($state_id) {
                    $query->where('id', $state_id);
                }
            })->orderBy('amount')->paginate(10);
        }
        return view('welcome', compact('rates', 'amount', 'currency_id', 'state_id', 'currencies', 'states'));
    }
}
