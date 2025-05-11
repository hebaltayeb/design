<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'designer_id', 
        'name', 
        'description', 
        'price', 
        'color', 
        'category_id', 
        'image', 
        'is_featured',
        'is_customizable', 
        'favorites_count', 
        'sales_count', 
        'seo_title', 
        'seo_description'
    ];

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
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function customizationRequests()
    {
        return $this->hasMany(CustomizeRequest::class);
    }
    
    /**
     * Calculate the average rating for this product.
     * 
     * @return float|null
     */
    public function getAverageRatingAttribute()
    {
        if ($this->ratings->count() === 0) {
            return null;
        }
        
        return round($this->ratings->avg('rating'), 1);
    }
}