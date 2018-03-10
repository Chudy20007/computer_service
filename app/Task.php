<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable=[
        'supervisor_id',
        'employee_id',
        'order_id',
        'message',
       'updated_at',
       'created_at'
    ];
}
