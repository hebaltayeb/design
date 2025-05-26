<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Enrollment;
use App\Models\Category;
use App\Models\LearningPoint;

class Course extends Model
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
        'price',
        'video_url',
        'preview_url',
        'duration',
        'lessons_count',
        'level',
        'language',
        'image',
        'category_id',
        'start_date',
        'end_date',
        "created_at",
        "updated_at",
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'price' => 'decimal:2',
        'start_date' => 'date',
    ];

    /**
     * Get the designer that created this course.
     */
    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    /**
     * Get the enrollments for this course.
     */
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /**
     * Get the users enrolled in this course.
     */
    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'course_enrollments')->withTimestamps();
    }

    /**
     * Get the category this course belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the discounted price of the course if applicable.
     * 
     * @return float|null
     */
    public function getDiscountedPriceAttribute()
    {
        // You can add discount logic here if needed
        return null;
    }

    /**
     * Get the total number of students enrolled in this course.
     * 
     * @return int
     */
    public function getStudentsCountAttribute()
    {
        return $this->enrollments()->count();
    }

    /**
     * Get learning points associated with the course.
     */
    public function learningPoints()
    {
        return $this->hasMany(LearningPoint::class);
    }
}
