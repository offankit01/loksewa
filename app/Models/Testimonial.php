<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id',
        'user_name',
        'designation',
        'avatar',
        'content',
        'rating',
        'is_featured',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
