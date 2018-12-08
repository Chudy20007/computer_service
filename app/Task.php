<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'supervisor_id',
        'employee_id',
        'order_id',
        'message',
        'updated_at',
        'created_at',
        'title',
        'message',
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function employee()
    {
        return $this->hasOne('App\User', 'id', 'employee_id');
    }

    public function supervisor()
    {
        return $this->hasOne('App\User', 'id', 'supervisor_id');
    }
}
