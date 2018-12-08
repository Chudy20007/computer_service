<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->unsigned();
            $table->integer('task_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->string('message')->default($value = "empty");
            $table->boolean('active')->default($value = true);
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('task_id')->references('id')->on('tasks');
            $table->foreign('employee_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_messages');
    }
}
