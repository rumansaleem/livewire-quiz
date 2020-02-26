<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['pin', 'started_at', 'ended_at', 'current_question_index'];

    protected $casts = [
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
            session()->put("quiz_session.{$this->id}.nickname", $player->nickname);
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

    public function start()
    {
        return $this->update([
            'started_at' => now(),
            'pin' => null,
            'current_question_index' => 0,
        ]);
    }

    public function isActive()
    {
        return $this->started_at <= now() &&
            ! $this->ended_at;
    }
}
