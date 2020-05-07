<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = ['rate', 'user_id', 'currency_id'];

    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
