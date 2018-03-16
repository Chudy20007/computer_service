<?php

use Illuminate\Database\Seeder;
use App\User;
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
        for ($i = 0; $i < 5; $i++)
        {
        $user = new User();
        $user ->name = $faker->name;
        $user->email = $faker->email;
        $user->post_code = "56-200";
        $user->city = $faker->city;
        $user->street = "Kielecka";
        $user->local_number = rand(5, 25);
        $user->phone = rand(5, 32612);
        $user->password = bcrypt('willock');
        $user->role = 'admin';
        $user->save();
        }
    }
}
