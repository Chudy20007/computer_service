<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'name',
        'updadet_at',
        'created_at',
        'problem_description',
        'payment_method',
        'status',
        'tax',
        'total_price',
        'invoice_id',
    ];

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'id', 'invoice_id');
    }

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'employee_id');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'id', 'order_id');
    }

    public function customer()
    {
        return $this->hasOne('App\User', 'id', 'customer_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'customer_id', 'id');
    }
    public function order_object()
    {
        return $this->hasMany('App\OrderObject', 'order_id', 'order_id');
    }

    public function order_service()
    {
        return $this->hasMany('App\OrderService', 'order_id', 'order_id');
    }

    public function order_part()
    {
        return $this->hasMany('App\OrderPart', 'order_id', 'order_id');
    }
}
