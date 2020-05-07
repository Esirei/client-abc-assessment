<div class="card mt-3">
    <div class="card-body">
        <h4 class="card-title">
            NGN{{ number_format($rate->amount, 2) . ' / ' . $rate->currency->code }}
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
