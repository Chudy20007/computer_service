<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable=[
    'category_id',
    'name',
    'serial_number',
    'count',
    'price' 
   ];

   public function order()
   {
       $this->hasOne('App\Category','category_id');
   }

   public function category()
   {
      return $this->hasOne('App\Category','id','category_id');
   }
}
