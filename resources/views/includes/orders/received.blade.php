<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ number_format($order->amount) }} <small>{{ $order->rate->currency->code }}</small>
        </h4>
        <h4 class="card-title">NGN{{ number_format($order->amount * $order->rate->rate) }} @ {{ $order->rate->rate }}
            /{{ $order->rate->currency->code }}</h4>
        <p class="card-text">Buyer: {{ $order->user->name }} from {{ $order->user->state->name }} state</p>

        <form method="post" id="search" action="{{ route('order.expected-delivery') }}">
            @csrf
            <input type="hidden" name="order_id" value="{{ $order->id }}">
            <div class="form-row mb-3">
                <div class="col">
                    <label for="expected_delivery"><span
                                class="font-weight-bold">Expected delivery</span> {{ optional($order->expected_delivery)->toDateString() }}
                    </label>
                    <input type="date" class="form-control" id="expected_delivery" name="expected_delivery"
                           value="">
                </div>
            </div>
            <button type="submit" class="btn btn-primary align-self-center"
                    id="submit">{{ $order->expected_delivery ? 'Update' : 'Send' }} Response
            </button>
        </form>
    </div>
    <div class="card-footer text-muted"><small>Received at {{ $order->created_at }}</small></div>
</div>
