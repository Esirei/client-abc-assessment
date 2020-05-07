<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'rate_id', 'amount', 'expected_delivery'];

    protected $casts = ['expected_delivery' => 'datetime'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function rate() {
        return $this->belongsTo(Rate::class);
    }
}
