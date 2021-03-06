@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    {{--                    <div class="card-header">Dashboard</div>--}}

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="get" id="search" action="{{ route('welcome') }}">
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control" id="amount" name="amount" min="0"
                                           placeholder="Eg. 1000"
                                           value="{{ $amount ?? '' }}">
                                </div>

                                <div class="col">
                                    <label for="currency">Currency</label>
                                    <select name="currency" id="currency" class="form-control">
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ $currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="state">State</label>
                                    <select name="state" id="state" class="form-control">
                                        <option value="0">-Select State-</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ $state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary align-self-center" id="submit">Submit</button>
                        </form>
                    </div>
                </div>
                @foreach($rates as $rate)
                    @include('includes.rates.buyer_rate')
                @endforeach
                @if(count($rates) > 0)
                    <div class="row justify-content-center">
                        <div class="mt-4">
                            {{ $rates->withQueryString()->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
