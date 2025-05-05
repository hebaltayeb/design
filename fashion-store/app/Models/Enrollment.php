<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    
    protected $table = 'course_enrollments';
    
    protected $fillable = [
        'course_id', 'user_id', 'payment_status', 'enrolled_at'
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
