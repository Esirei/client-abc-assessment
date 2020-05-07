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
                                @include('includes.orders.received')
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
                            @include('includes.orders.sent')
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
