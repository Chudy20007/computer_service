<?php

use Illuminate\Database\Seeder;
use App\Service;
class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->name = "Laptop screen repair";
        $service->price = 120.00;
        $service->active = false;
        $service->save();
        $service=null;
        $service2 = new Service();
        $service2->name = "Laptop cleaning service";
        $service2->price = 50.00;
        $service2->active = true;
        $service2->save();
        $service2=null;
        $service3 = new Service();
        $service3->name = "Laptop fan replacement";
        $service3->price = 66.50;
        $service3->active = true;
        $service3->save();
        $service4=null;
        $service4 = new Service();
        $service4->name = "Data recovery";
        $service4->price = 80.30;
        $service4->active = true;
        $service4->save();

    }
}
