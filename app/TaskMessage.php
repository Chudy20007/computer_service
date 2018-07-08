<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMessage extends Model
{
    protected $fillable = [
        'task_id',
        'order_id',
        'employee_id',
        'name',
        'message',
        'active',

    ];

    public function task()
    {
        return $this->belongsTo('App\Task', 'task_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo('App\User', 'employee_id', 'id');
    }

    public function supervisor()
    {
        return $this->hasOne('App\User', 'id', 'supervisor_id');
    }
}
