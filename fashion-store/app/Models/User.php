<?php
// This is not the complete User.php file, but just the portions you need to add
// to your existing User model to support the landing page functionality

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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
     * Check if the user is a designer.
     *
     * @return bool
     */
    public function isDesigner(): bool
    {
        return $this->is_designer;
    }
}