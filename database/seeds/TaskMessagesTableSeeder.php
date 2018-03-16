<?php

use Illuminate\Database\Seeder;
use App\TaskMessage;
class TaskMessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<3; $i++)
        {
        $t1_message = new TaskMessage();
        $t1_message->task_id = 1;
        $t1_message->order_id = 1;
        $t1_message->employee_id = 1;
        $t1_message->message = "First message".$i;
        $t1_message->active = true;
        $t1_message->save();

        $t2_message = new TaskMessage();
        $t2_message->order_id = 2;
        $t2_message->task_id = 2;
        $t2_message->employee_id = 1;
        $t2_message->message = "Second message".$i;
        $t2_message->active = true;
        $t2_message->save();

        }
    }
}
