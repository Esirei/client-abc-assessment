<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Currency;
use App\Rate;
use App\User;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    $currency = Currency::query()->inRandomOrder()->limit(1)->first();
    $rate = $currency->rate;
    return [
        'user_id' => User::query()->inRandomOrder()->limit(1)->first(['id'])->id,
        'currency_id' => $currency->id,
        'rate' => $faker->numberBetween(round($rate * 0.85), round($rate * 1.2)),
    ];
});
