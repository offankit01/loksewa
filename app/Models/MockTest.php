<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'time_limit',
        'difficulty',
        'study_material_id',
        'course_id',
        'is_published',
        'is_ai_generated',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studyMaterial()
    {
        return $this->belongsTo(StudyMaterial::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function attempts()
    {
        return $this->hasMany(TestAttempt::class);
    }
}
