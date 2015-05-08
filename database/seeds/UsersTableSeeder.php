<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    public function run()
    {
        Eloquent::unguard();
        $faker = Faker\Factory::create();

        for($i=1; $i < 20; $i++ ){
             $data = [
                        'name' => $faker->name,
                        'email' => $faker->email,
                        'password' => bcrypt('demodemo')
                    ];

            \App\User::create($data);
        }

    }

}