<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
 {

    public function hasDiscount()
    {
        if (!$this->discount) {
            return false;
        }
        
        $now = now();
        return $now->between($this->discount->start_date, $this->discount->end_date);
    }
    
    /**
     * Get the discounted price of the product.
     * 
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        if (!$this->hasDiscount()) {
            return $this->price;
        }
        
        if ($this->discount->is_percentage) {
            return $this->price - ($this->price * $this->discount->discount_value / 100);
        }
        
        return $this->price - $this->discount->discount_value;
    }
    
    public function designer()
{
    return $this->belongsTo(User::class, 'designer_id');
}




  use HasFactory;
    
    protected $fillable = [         'designer_id', 'name', 'description', 'price', 
        'color', 'category', 'image', 'is_featured', 
        'favorites_count', 'sales_count', 'seo_title', 'seo_description'
    ];

   

   public function sizes()
  {
        return $this->hasMany(Size::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }
    public function ratings()
{
    return $this->hasMany(Rating::class);
}
}