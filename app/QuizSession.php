<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['pin', 'ready_at', 'current_question_index'];

    protected $casts = [
        'ready_at' => 'datetime'
    ];

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

    public function ready()
    {
        return $this->update([
            'ready_at' => now(),
            'pin' => null,
            'current_question_index' => 0,
        ]);
    }

    public function isReady()
    {
        return $this->ready_at != null && $this->ready_at < now();
    }
}
