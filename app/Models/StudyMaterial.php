<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'file_path',
        'category',
        'downloads',
        'is_premium',
    ];

    public function mockTests()
    {
        return $this->hasMany(MockTest::class);
    }
}
