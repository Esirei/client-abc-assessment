<?php

namespace App\Http\Controllers;

use App\Order;
use App\Rate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rate_id = $request->get('rate_id');
        $amount = $request->get('amount');
        $order = Order::query()->create(['user_id' => auth()->id(), 'amount' => $amount, 'rate_id' => $rate_id]);
        $request->session()->flash('status', 'Request successfully sent.');
        return redirect()->route('home');
    }

    public function expectedDelivery(Request $request)
    {
        $order = Order::query()->find($request->post('order_id'));
        $order->update(['expected_delivery' => $request->post('expected_delivery')]);
        $request->session()->flash('status', 'Expected delivery updated.');
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
