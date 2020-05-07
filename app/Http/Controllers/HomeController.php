<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::with(['rate.currency', 'rate.user', 'user'])->where('user_id', auth()->id())->latest()->get();
        $receivedOrders = [];

        if (auth()->user()->is_seller) {
            $receivedOrders = Order::with(['rate.currency', 'rate.user', 'user'])->whereHas('rate.user', function (Builder $query) {
                $query->where('id', auth()->id());
            })->latest()->get();
        }

        return view('home', compact('orders', 'receivedOrders'));
    }
}
