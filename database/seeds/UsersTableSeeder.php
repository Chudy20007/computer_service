<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->post_code = "56-200";
            $user->city = $faker->city;
            $user->street = "Kielecka";
            $user->local_number = rand(5, 25);
            $user->phone = rand(5, 32612);
            $user->password = bcrypt('willock');
            $user->role = 'admin';
            $user->save();

            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->post_code = "11-111";
            $user->city = "Berlin";
            $user->street = "Alexander Platz";
            $user->local_number = rand(15, 45);
            $user->phone = rand(235, 32612);
            $user->password = bcrypt('willock');
            $user->role = 'employee';
            $user->save();

            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->post_code = "41-341";
            $user->city = "Warszawa";
            $user->street = "Krzywa";
            $user->local_number = rand(15, 55);
            $user->phone = rand(325, 32612);
            $user->password = bcrypt('willock');
            $user->role = 'supervisor';
            $user->save();
        }
    }
}
