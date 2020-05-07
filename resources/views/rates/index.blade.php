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

            <div class="col-md-8">
                <a href="{{ route('rate.create') }}">Add Rate</a>
                <div class="card my-3">
                    <div class="card-header">Your Rates</div>
                    <div class="card-body">

                        @foreach($rates as $rate)
                            @include('includes.rates.seller_rate')
                        @endforeach

                    </div>
                </div>
                <a href="{{ route('rate.create') }}">Add Rate</a>
            </div>
        </div>
    </div>
@endsection
