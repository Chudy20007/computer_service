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

    public function order()
    {
        $this->belongsTo('App\Order','order_id');
    }

    public function employee()
    {
        $this->hasOne('App\User','employee_id');
    }

    public function supervisor()
    {
        $this->hasOne('App\Order','supervisor_id');
    }
}
