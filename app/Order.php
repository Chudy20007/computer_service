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
        return  $this->belongsTo('App\Invoice','customer_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Invoice','employee_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User','customer_id');
    }
    public function order_object()
    {
        return $this->hasMany('App\OrderObject','order_id');
    }
}