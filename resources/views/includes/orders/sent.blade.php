<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">{{ number_format($order->amount) }} <small>{{ $order->rate->currency->code }}</small>
        </h4>
        <h4 class="card-title">
            NGN{{ number_format($order->amount * $order->rate->amount) }}
            @ {{ $order->rate->amount . '/' . $order->rate->currency->code }}
        </h4>
        <p class="card-text">Seller: {{ $order->rate->user->name }} at {{ $order->rate->user->state->name }} state</p>
        <p>
            <span class="font-weight-bold">Expected delivery:</span>
            {{ is_null($order->expected_delivery) ? 'Awaiting response from seller' : $order->expected_delivery->toDateString() }}
        </p>
    </div>
    <div class="card-footer text-muted"><small>Sent at {{ $order->created_at }}</small></div>
</div>
