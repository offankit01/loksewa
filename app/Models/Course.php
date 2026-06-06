<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'slug',
        'description',
        'icon',
        'price',
        'is_active',
    ];

    public function mockTests()
    {
        return $this->hasMany(MockTest::class);
    }

    public function studyMaterials()
    {
        return $this->hasMany(StudyMaterial::class);
    }
}
