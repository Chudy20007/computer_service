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
        'updated_at',
        'execution_time',
        'received'
    ];

    public function customer()
    {
        return  $this->hasOne('App\User','id','customer_id');
    }

    public function employee()
    {
        return $this->hasOne('App\User','id','employee_id');
    }

    public function user()
    {
        return $this->hasOne('App\User','customer_id','id');
    }
    public function order_object()
    {
        return $this->hasMany('App\OrderObject','order_id');
    }

    public function order_service()
    {
        return $this->hasMany('App\OrderService','order_id');
    }

    public function order_part()
    {
        return $this->hasMany('App\OrderPart','order_id');
    }

    public function order_id()
    {
        return $this->id;
    }
}