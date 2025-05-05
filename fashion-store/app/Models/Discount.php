<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;    

 class Discount extends Model
 {
    

     protected $fillable = [
        'product_id', 'discount_value', 'is_percentage', 'start_date', 'end_date'
    ];
         protected $dates = ['start_date', 'end_date'];
     public function product()
     {
       return $this->belongsTo(Product::class);
   }
 }
