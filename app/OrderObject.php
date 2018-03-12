<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

    class OrderObject extends Model
{
    protected $fillable= [
        'problem_description',
        'diagnosis',
        'serial_number',
        'order_id',
        'fixed',
        'created_at',
        'updated_at'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order','order_id');
    }
}
