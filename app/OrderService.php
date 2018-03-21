<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    protected $fillable=[
        'order_id',
        'service_id'
    ];
    public $timestamps = false;

    public function order()
    {
       return $this->belongsTo('App\Order','order_id');
    }
    public function service()
    {
       return $this->belongsTo('App\Service','service_id');
    }
}
