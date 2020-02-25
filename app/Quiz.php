<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Quiz extends Model
{
    protected $fillable = ['title'];

    public function startSession($pin)
    {
        return $this->sessions()->create(['pin' => $pin]);
    }

    public function sessions()
    {
        return $this->hasMany(QuizSession::class, 'quiz_id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}
