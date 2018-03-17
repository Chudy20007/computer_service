<?php

use Illuminate\Database\Seeder;
use App\OrderService;
class OrderServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<3; $i++)
        {
            $order_service = new OrderService();
            $order_service->service_id =$i;
            $order_service->order_id = 1;
            $order_service->active=true;
            $order_service->save();
        }

        for ($i=1; $i<4; $i++)
        {
            $order_service = new OrderService();
            $order_service->service_id =$i;
            $order_service->order_id = 2;
            $order_service->active=true;
            $order_service->save();
        }
    }
}
