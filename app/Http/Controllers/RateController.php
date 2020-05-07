<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
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
        $rates = Rate::query()->where('user_id', auth()->id())->latest('updated_at')->get();
        return view('rates.index', compact('rates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = Currency::all();
        return view('rates.create', compact('currencies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $amount = $request->post('amount');
        $currency_id = $request->post('currency');
        Rate::query()->create(['amount' => $amount, 'currency_id' => $currency_id, 'user_id' => auth()->id()]);
        $request->session()->flash('status', 'Your fx rate was created successfully');
        return redirect()->route('rate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function edit(Rate $rate)
    {
        $currencies = Currency::all();
        return view('rates.create', compact('rate', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rate $rate)
    {
        $this->validate($request, [
            'amount' => 'required',
        ]);

        $amount = $request->post('amount');
        $currency_id = $request->post('currency');

        // Should probably cancel every request made on this rate here.

        $rate->update(['amount' => $amount, 'currency_id' => $currency_id]);
        $request->session()->flash('status', 'Your fx rate was updated successfully');
        return redirect()->route('rate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rate  $rate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rate $rate)
    {
        // Should probably cancel every request made on this rate here.

        $rate->delete();
        \request()->session()->flash('status', 'Fx rate has been deleted');
        return redirect()->back();
    }
}
