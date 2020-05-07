<?php

use App\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = json_decode(file_get_contents(storage_path('json/currencies.json')), true);
        Currency::query()->create($currencies);
    }
}
