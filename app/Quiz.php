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

    public function freshSession()
    {
        return $this->belongsTo(QuizSession::class, 'fresh_quiz_session_id');
    }

    public function scopeWithFreshSession($query)
    {
        return $query->addSelect([
            'fresh_quiz_session_id' => QuizSession::select('id')
                ->whereColumn('quiz_id', 'id')->fresh()->limit(1)
        ])->with('freshSession');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'quiz_id');
    }
}
