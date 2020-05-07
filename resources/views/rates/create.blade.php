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
                <a href="{{ route('rate.index') }}">Index</a>
                <div class="card my-3">
                    <div class="card-header">{{ isset($rate) ? 'Edit' : 'Add' }} Fx Rate</div>
                    <div class="card-body">

                        <form method="post" action="{{ isset($rate) ? route('rate.update', $rate->id) : route('rate.store') }}">
                            @if(isset($rate))
                                @method('put')
                            @endif
                            @csrf
                            <div class="form-row mb-3">
                                <div class="col">
                                    <label for="amount">Amount</label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                           id="amount" name="amount" min="0"
                                           placeholder="Eg. 1000"
                                           value="{{ old('amount', optional($rate ?? '')->amount) }}">

                                    @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="currency">Currency</label>
                                    <select name="currency" id="currency" class="form-control">
                                        @foreach($currencies as $currency)
                                            <option
                                                value="{{ $currency->id }}" {{ old('currency', optional($rate ?? '')->currency_id) == $currency->id ? 'selected' : '' }}>{{ $currency->code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary align-self-center" id="submit">{{ $rate ?? '' ? 'Update' : 'Add' }}</button>
                        </form>
                    </div>
                </div>
                <a href="{{ route('rate.index') }}">Index</a>
            </div>
        </div>
    </div>
@endsection
