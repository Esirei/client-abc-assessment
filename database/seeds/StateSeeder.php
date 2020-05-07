<?php

use App\State;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = json_decode(file_get_contents(storage_path('json/states.json')), true);
        foreach ($states as $state) {
            State::query()->insert(['name' => $state]);
        }
    }
}
