<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
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
        'invoice_id'
    ];

    public function invoice()
    {
        $this->belongsTo('App\Invoice','invoice_id')->withTimestamps();
    }
}
