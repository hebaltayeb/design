<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Product extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'designer_id',
//         'name',
//         'description',
//         'price',
//         'color',
//         'category',
//         'image',
//         'is_featured',
//         'favorites_count',
//         'sales_count',
//         'seo_title',
//         'seo_description',
//     ];

//     protected $casts = [
//         'is_featured' => 'boolean',
//         'price' => 'float',
//     ];

//     public function designer()
//     {
//         return $this->belongsTo(User::class, 'designer_id');
//     }

//     public function sizes()
//     {
//         return $this->hasMany(Size::class);
//     }

//     public function discount()
//     {
//         return $this->hasOne(Discount::class);
//     }

//     public function ratings()
//     {
//         return $this->hasMany(Rating::class);
//     }

//     public function favorites()
//     {
//         return $this->hasMany(Favorite::class);
//     }

//     public function cartItems()
//     {
//         return $this->hasMany(Cart::class);
//     }

//     public function orderItems()
//     {
//         return $this->hasMany(OrderItem::class);
//     }

//     public function customizeRequests()
//     {
//         return $this->hasMany(CustomizeRequest::class);
//     }

//     // Get final price after discount
//     public function getFinalPriceAttribute()
//     {
//         if ($this->discount && now()->between($this->discount->start_date, $this->discount->end_date)) {
//             if ($this->discount->is_percentage) {
//                 return $this->price * (1 - $this->discount->discount_value / 100);
//             } else {
//                 return $this->price - $this->discount->discount_value;
//             }
//         }
//         return $this->price;
//     }

//     // Check if product is on sale
//     public function getIsOnSaleAttribute()
//     {
//         return $this->discount && now()->between($this->discount->start_date, $this->discount->end_date);
//     }

//     // Get average rating
//     public function getAverageRatingAttribute()
//     {
//         return $this->ratings->avg('rating');
//     }
// }




// class Product extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'designer_id', 'name', 'description', 'price', 'color', 
//         'category', 'image', 'is_featured', 'favorites_count', 
//         'sales_count', 'seo_title', 'seo_description'
//     ];

//     public function designer()
//     {
//         return $this->belongsTo(User::class, 'designer_id');
//     }

//     public function sizes()
//     {
//         return $this->hasMany(Size::class);
//     }

//     public function discount()
//     {
//         return $this->hasOne(Discount::class)->where('end_date', '>=', now())->where('start_date', '<=', now());
//     }

//     public function ratings()
//     {
//         return $this->hasMany(Rating::class);
//     }

//     public function getAverageRatingAttribute()
//     {
//         return $this->ratings->avg('rating') ?? 0;
//     }

//     public function getAvailableSizesAttribute()
//     {
//         return $this->sizes->where('stock_quantity', '>', 0)->pluck('size');
//     }

//     public function getDiscountedPriceAttribute()
//     {
//         if (!$this->discount) {
//             return $this->price;
//         }

//         if ($this->discount->is_percentage) {
//             return $this->price - ($this->price * $this->discount->discount_value / 100);
//         }

//         return $this->price - $this->discount->discount_value;
//     }

//     public function hasDiscount()
//     {
//         return $this->discount !== null;
//     }
// }




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




//     use HasFactory;
    
//     protected $fillable = [
//         'designer_id', 'name', 'description', 'price', 
//         'color', 'category', 'image', 'is_featured', 
//         'favorites_count', 'sales_count', 'seo_title', 'seo_description'
//     ];

//     public function designer()
//     {
//         return $this->belongsTo(User::class, 'designer_id');
//     }

//     public function sizes()
//     {
//         return $this->hasMany(Size::class);
//     }

//     public function discount()
//     {
//         return $this->hasOne(Discount::class);
//     }
}