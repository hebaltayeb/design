<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPoint extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'description',
    ];

    /**
     * Get the course that owns the learning point.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}