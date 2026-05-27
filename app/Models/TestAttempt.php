<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mock_test_id',
        'score',
        'total_questions',
        'correct_answers',
        'wrong_answers',
        'time_taken',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mockTest()
    {
        return $this->belongsTo(MockTest::class);
    }

    public function answers()
    {
        return $this->hasMany(AttemptAnswer::class);
    }
}
