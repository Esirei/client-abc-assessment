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
                            <div class="card mt-3">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        NGN{{ number_format($rate->amount) . ' / ' . $rate->currency->code }}
                                    </h4>

                                    <a href="{{ route('rate.edit', ['rate' => $rate->id]) }}">Edit</a>

                                    <a class="text-danger ml-2"
                                       href="{{ route('rate.destroy', ['rate' => $rate->id]) }}"
                                       onclick="event.preventDefault(); const x = confirm('Delete?'); if(x) document.getElementById('{{ "delete-rate-" . $rate->id }}').submit();">Delete</a>

                                    <form id="{{ 'delete-rate-' . $rate->id }}"
                                          action="{{ route('rate.destroy', ['rate' => $rate->id]) }}" method="post"
                                          style="display: none;">
                                        @method('delete')
                                        @csrf
                                    </form>
                                </div>
                                <div class="card-footer text-muted">
                                    <small>Created at: {{ $rate->created_at }}</small>
                                    @if($rate->created_at != $rate->updated_at)
                                        , <small>Updated at: {{ $rate->updated_at }}</small>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <a href="{{ route('rate.create') }}">Add Rate</a>
            </div>
        </div>
    </div>
@endsection
