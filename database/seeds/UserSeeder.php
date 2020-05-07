<?php

use App\Rate;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 100)->create(['is_seller' => true])->each(function ($user){
            factory(Rate::class, 4)->create(['user_id' => $user->id]);
        });
    }
}
