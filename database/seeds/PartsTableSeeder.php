<?php

use Illuminate\Database\Seeder;
use App\Part;
class PartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        $part = new Part();
        $part->category_id = 3;
        $part->serial_number="13821512219312";
        $part->count = 50;
        $part->price = 30.52;
        $part->active=true;
        $part->save();
        $part=null;
        $part2 = new Part();
        $part2->category_id = 2;
        $part2->serial_number="126821939312";
        $part2->count = 10;
        $part2->price = 20.52;
        $part2->active=true;
        $part2->save();
        $part2=null;
        $part3 = new Part();
        $part3->category_id = 1;
        $part3->serial_number="119312319312";
        $part3->count = 5;
        $part3->price = 10.31;
        $part3->active=true;
        $part3->save();
        $part4=null;
        $part4 = new Part();
        $part4->category_id = 3;
        $part4->serial_number="1299911572";
        $part4->count = 3;
        $part4->price = 49.82;
        $part4->active=false;
        $part4->save();
        
    }
}
