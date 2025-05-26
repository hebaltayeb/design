<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FashionEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'date',
        'time',
        'designer_id',
        'image',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }
}