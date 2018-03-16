<?php

use Illuminate\Database\Seeder;
use App\Order;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $order->customer_id=2;
        $order->employee_id=1;
        $order->status=true;
        $order->description = "test";
        $order->save();

        $order2 = new Order();
        $order2->customer_id=3;
        $order2->employee_id=1;
        $order2->status=true;
        $order2->description = "test22222";
        $order2->save();
        
    }
}
