<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'user_name',
        'designation',
        'avatar',
        'content',
        'rating',
        'is_featured',
        'is_active'
    ];
}
