<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trivia extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'question',
        'answer',
        'correct_answer',
        'correct_answers_count'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
