<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',40);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('city',50);
            $table->string('post_code',10);
            $table->string('local_number',10);
            $table->string('phone',15);
            $table->string('street',25);
            $table->boolean('active')->default($value=true);
            $table->string('role',20)->default($value='customer');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
