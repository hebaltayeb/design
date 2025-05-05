<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'discount_value',
        'is_percentage',
        'valid_from',
        'valid_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'discount_value' => 'decimal:2',
        'is_percentage' => 'boolean',
        'valid_from' => 'date',
        'valid_to' => 'date',
    ];

    /**
     * Determine if the coupon is currently valid.
     *
     * @return bool
     */
    public function isValid()
    {
        $now = now()->startOfDay();
        return $now->between($this->valid_from, $this->valid_to);
    }
}