<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomizeRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'size',
        'color',
        'fabric_type',
        'sleeve_type',
        'custom_note',
        'status',
        'designer_response',
    ];

    /**
     * Get the user that made this customize request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product that this customize request is for.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}