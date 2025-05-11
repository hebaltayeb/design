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

    /**
     * Get the designer of the product.
     */
    public function designer()
    {
        return $this->product->designer();
    }

    /**
     * Check if the request has been responded to.
     *
     * @return bool
     */
    public function hasResponse()
    {
        return !empty($this->designer_response);
    }

    /**
     * Check if the request is pending.
     *
     * @return bool
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if the request is approved.
     *
     * @return bool
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if the request is rejected.
     *
     * @return bool
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }
}