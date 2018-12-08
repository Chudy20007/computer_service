<?php

use App\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t1 = new Task();
        $t1->supervisor_id = 5;
        $t1->employee_id = 1;
        $t1->order_id = 1;
        $t1->title = "First title";
        $t1->message = "First message";
        $t1->active = true;
        $t1->save();

        $t2 = new Task();
        $t2->supervisor_id = 5;
        $t2->employee_id = 1;
        $t2->order_id = 2;
        $t2->title = "Second title";
        $t2->message = "Second message";
        $t2->active = false;
        $t2->save();
    }
}
