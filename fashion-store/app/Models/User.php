<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_designer',
        'profile_picture',
        'bio',
        'role', // Add this line
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_designer' => 'boolean',
    ];

    /**
     * Get the products created by this designer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'designer_id');
    }

    /**
     * Get the courses created by this designer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'designer_id');
    }

    /**
     * Get the events created by this designer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(FashionEvent::class, 'designer_id');
    }

    /**
     * Get the favorites of this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Get the customization requests made by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany 
     */
    public function customizationRequests(): HasMany
    {
        return $this->hasMany(CustomizeRequest::class);
    }

    /**
     * Get the course enrollments of this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the event RSVPs of this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function eventRSVPs(): HasMany
    // {
    //     return $this->hasMany(EventRSVP::class);
    // }

    /**
     * Get the media items (gallery) of this designer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mediaItems(): HasMany
    {
        return $this->hasMany(DesignerMedia::class, 'designer_id');
    }

    /**
     * Check if user has favorited a product.
     *
     * @param int $productId
     * @return bool
     */
    public function hasFavorited(int $productId): bool
    {
        return $this->favorites()
                    ->where('product_id', $productId)
                    ->exists();
    }

    /**
     * Get all products favorited by this user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoritedProducts()
    {
        return $this->belongsToMany(Product::class, 'favorites')
                    ->withTimestamps();
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user is a superadmin.
     *
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin'; // Updated to match migration
    }

    /**
     * Check if the user has admin privileges (admin or superadmin).
     *
     * @return bool
     */
    public function hasAdminAccess(): bool
    {
        return in_array($this->role, ['admin', 'super_admin']); // Updated to match migration
    }

    /**
     * Check if the user is a designer.
     *
     * @return bool
     */
    public function isDesigner(): bool
    {
        return $this->is_designer || $this->role === 'designer';
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    // Orders for products designed by this user (through order items)
    public function designerOrders()
    {
        return Order::whereHas('orderItems.product', function ($query) {
            $query->where('designer_id', $this->id);
        });
    }

}