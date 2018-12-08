<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(PartsTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(OrdersTableSeeder::class);
        $this->call(OrderObjectsTableSeeder::class);
        $this->call(OrderPartsTableSeeder::class);
        $this->call(OrderServicesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(TaskMessagesTableSeeder::class);
    }
}
