<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'size',
        'quantity',
        'price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    /**
     * Get the order that this item belongs to.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product of this order item.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}