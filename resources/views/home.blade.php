@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-12">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        @if(auth()->user()->is_seller)
            <div class="col-lg-8 col-md-6">
                <div class="card">
                    <div class="card-header">Received Requests</div>
                    <div class="card-body">

                        @if(count($receivedOrders) > 0)
                            @foreach($receivedOrders as $order)
                                <div class="card mt-3">
                                    <div class="card-body">
                                        <h4 class="card-title">{{ number_format($order->amount) }} <small>{{ $order->rate->currency->code }}</small></h4>
                                        <h4 class="card-title">NGN{{ number_format($order->amount * $order->rate->rate) }} @ {{ $order->rate->rate }}/{{ $order->rate->currency->code }}</h4>
                                        <p class="card-text">Buyer: {{ $order->user->name }} from {{ $order->user->state->name }} state</p>

                                        <form method="post" id="search" action="{{ route('order.expected-delivery') }}">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <div class="form-row mb-3">
                                                <div class="col">
                                                    <label for="expected_delivery"><span class="font-weight-bold">Expected delivery</span> {{ optional($order->expected_delivery)->toDateString() }}</label>
                                                    <input type="date" class="form-control" id="expected_delivery" name="expected_delivery"
                                                           value="">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary align-self-center" id="submit">{{ $order->expected_delivery ? 'Update' : 'Send' }} Response</button>
                                        </form>
                                    </div>
                                    <div class="card-footer text-muted"><small>Received at {{ $order->created_at }}</small></div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center">No Request has been received.</div>
                        @endif

                    </div>
                </div>
            </div>
        @endif

        <div class="{{ auth()->user()->is_seller ? 'col-lg-4 mt-md-0 mt-4' : 'col-lg-8' }} col-md-6">
            <div class="card">
                <div class="card-header">Sent Requests</div>
                <div class="card-body">

                    @if(count($orders) > 0)
                        @foreach($orders as $order)
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4 class="card-title">{{ number_format($order->amount) }} <small>{{ $order->rate->currency->code }}</small></h4>
                                    <h4 class="card-title">NGN{{ number_format($order->amount * $order->rate->rate) }} @ {{ $order->rate->rate }}/{{ $order->rate->currency->code }}</h4>
                                    <p class="card-text">Seller: {{ $order->rate->user->name }} at {{ $order->rate->user->state->name }} state</p>
                                    <p><span class="font-weight-bold">Expected delivery: </span>{{ is_null($order->expected_delivery) ? 'Awaiting response from seller' : $order->expected_delivery->toDateString() }}</p>
                                </div>
                                <div class="card-footer text-muted"><small>Sent at {{ $order->created_at }}</small></div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center">No Request has been sent.</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
