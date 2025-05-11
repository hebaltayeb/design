<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRSVP extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_rsvps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'event_id',
        'name',
        'email',
        'phone',
        'guest_count',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'guest_count' => 'integer',
    ];

    /**
     * Get the user that made this RSVP.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event that this RSVP is for.
     */
    public function event()
    {
        return $this->belongsTo(FashionEvent::class, 'event_id');
    }
}