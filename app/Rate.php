<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
