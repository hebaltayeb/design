<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FashionEvent extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'designer_id',
        'title',
        'description',
        'event_date',
        'location',
        'event_banner',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'event_date' => 'date',
    ];

    /**
     * Get the designer that created this fashion event.
     */
    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }
}