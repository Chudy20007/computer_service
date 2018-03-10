<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Object extends Model
{
    protected $fillable= [
        'problem_description',
        'diagnosis',
        'serial_number',
        'order_id',
        'fixed'
    ];
}
