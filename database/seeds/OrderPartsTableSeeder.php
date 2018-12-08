<?php

use App\OrderPart;
use Illuminate\Database\Seeder;

class OrderPartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 3; $i++) {
            $order_parts = new OrderPart();
            $order_parts->part_id = $i;
            $order_parts->order_id = 1;
            $order_parts->active = true;
            $order_parts->save();
        }
        for ($i = 1; $i < 3; $i++) {
            $order_parts = new OrderPart();
            $order_parts->part_id = $i;
            $order_parts->order_id = 2;
            $order_parts->active = true;
            $order_parts->save();
        }
    }
}
