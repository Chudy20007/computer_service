<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable= [
        'name',
        'updadet_at',
        'created_at',
        'problem_description',
        'payment_method',
        'status',
        'tax',
        'total_price',
        'order_id',
        'employee_id'
    ];

    public function employee()
    {
        $this->hasOne('App\User','employee_id');
    }

    public function order()
    {
        $this->belongsTo('App\Order','order_id')->withTimestamps();
    }
}
