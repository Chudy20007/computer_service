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

    public function customer()
    {
        $this->belongsTo('App\Invoice','customer_id');
    }

    public function employee()
    {
        $this->hasOne('App\Invoice','employee_id');
    }
}