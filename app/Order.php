<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable=[
       
       'customer_id',
       'employee_id',
        'status',
        'created_at',
        'updated_at'
    ];
}