<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderPart extends Model
{
    protected $fillable = [
        'part_id',
        'order_id',
    ];
    public $timestamps = false;
    public function order()
    {
        $this->belongsTo('App\Order', 'order_id');
    }
    public function object()
    {
        return $this->belongsTo('App\Object', 'order_id')->where('order_id', '=', 'id');
    }

    public function part()
    {
        return $this->belongsTo('App\Part', 'part_id');
    }
}
