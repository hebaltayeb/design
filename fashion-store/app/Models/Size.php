<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// class Size extends Model
// {
//     use HasFactory;

//     /**
//      * The attributes that are mass assignable.
//      *
//      * @var array<int, string>
//      */
//     protected $fillable = [
//         'product_id',
//         'size',
//         'stock_quantity',
//     ];

//     /**
//      * The attributes that should be cast.
//      *
//      * @var array<string, string>
//      */
//     protected $casts = [
//         'stock_quantity' => 'integer',
//     ];

//     /**
//      * Get the product that this size belongs to.
//      */
//     public function product()
//     {
//         return $this->belongsTo(Product::class);
//     }
// }


class Size extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'size', 'stock_quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
