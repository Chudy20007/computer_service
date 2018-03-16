<?php

use Illuminate\Database\Seeder;
use App\OrderObject;
class OrderObjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $object = new OrderObject();
        $object->order_id = 1;
        $object->name = "Samsung TC 550";
        $object->serial_number = "12093213";
        $object->diagnosis = "...";
        $object->fixed = false;
        $object->active = true;


        $object->save();

        $object2 = new OrderObject();
        $object2->order_id = 1;
        $object2->name = "Asus XV 129";
        $object2->serial_number = "121941213";
        $object2->diagnosis = "ob2";
        $object2->fixed = false;
        $object2->active = true;


        $object2->save();

        $object3 = new OrderObject();
        $object3->order_id = 2;
        $object3->name = "Dell 3385";
        $object3->serial_number = "12021399193";
        $object3->diagnosis = "ob3";
        $object3->fixed = false;
        $object3->active = true;


        $object3->save();

        $object4 = new OrderObject();
        $object4->order_id = 2;
        $object4->name = "Dell 5587";
        $object4->serial_number = "2131232";
        $object4->diagnosis = "ob4";
        $object4->fixed = false;
        $object4->active = false;


        $object4->save();

    }
}
