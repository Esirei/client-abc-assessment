<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">
            NGN{{ number_format($amount * $rate->rate) }}
            @ {{ $rate->rate . '/' . $rate->currency->code }}
        </h4>
        <p class="card-text">Seller: {{ $rate->user->name }} at {{ $rate->user->state->name }} state</p>
        <a href="{{ route('order.create', ['rate_id' => $rate->id, 'amount' => $amount]) }}" class="btn btn-primary"
           onclick="return confirm('Are you sure?')">Request</a>
    </div>
</div>
