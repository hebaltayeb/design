<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'module_id', 'order', 'duration', 'content', 'video_url'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}