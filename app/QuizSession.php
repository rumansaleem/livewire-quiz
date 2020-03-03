<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\NextQuestion;
use App\Events\QuizSessionEnded;

class QuizSession extends Model
{
    protected $fillable = ['pin', 'started_at', 'ended_at', 'next_question_at', 'current_question_index'];

    protected $casts = [
        'next_question_at' => 'datetime',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where('started_at', '<=', now())
            ->whereNull('ended_at');
    }

    public function scopeFresh($query)
    {
        return $query->whereNull('started_at')
            ->whereNull('ended_at');
    }

    public function scopeStale($query)
    {
        return $query->whereNotNull('started_at')
            ->where('ended_at', '<', now());
    }

    public function joinAs($nickname)
    {
        return tap($this->players()->firstOrCreate(['nickname' => $nickname]), function($player) {
            PlayerSession::nickname($player->nickname);
        });
    }

    public function players()
    {
        return $this->hasMany(QuizPlayer::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function start($delayInSeconds = 0)
    {
        return $this->update([
            'started_at' => now(),
            'next_question_at' => now()->addSeconds($this->quiz->questions->first()->time_limit + $delayInSeconds),
            'pin' => null,
            'current_question_index' => 0,
        ]);
    }

    public function nextQuestion($delayInSeconds = 0)
    {
        $this->current_question_index++;
        $question = $this->quiz->questions->get($this->current_question_index, null);

        if (! $question) {
            return $this->endSession();
        }

        $this->next_question_at = now()->addSeconds($question->time_limit + $delayInSeconds);
        $this->save();

        event(new NextQuestion($this, $question));

        return $question;
    }

    public function endSession()
    {
        $this->update([
            'ended_at' => now(),
            'current_question_index' => null,
            'next_question_at' => null
        ]);

        event(new QuizSessionEnded($this));
    }

    public function isActive()
    {
        return $this->started_at && $this->started_at <= now()
            && ! $this->ended_at;
    }

    public function responses()
    {
        return $this->hasManyThrough(QuestionResponse::class, QuizPlayer::class, 'quiz_session_id', 'player_id');
    }

    public function currentQuestion()
    {
        $index = $this->current_question_index;

        return $this->quiz->questions->get($index, null);
    }

    public function currentResponses()
    {
        $currentQuestion = $this->quiz->questions[$this->current_question_index];
        return $this->responses()->where('question_id', $currentQuestion->id);
    }

    public function hasTimedOut()
    {
        return $this->ended_at
            || ! $this->next_question_at
            || $this->next_question_at < now();
    }
}
