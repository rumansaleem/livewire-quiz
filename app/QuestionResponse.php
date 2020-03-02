<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionResponse extends Model
{
    protected $fillable = ['question_id', 'response'];

    public function player()
    {
        return $this->belongsTo(QuizPlayer::class, 'player_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    public function evaluate()
    {
        $timeLeft = $this->player->session->next_question_at->diffInSeconds($this->created_at, true);
        $timeLeft = $timeLeft < 0 ? 0 : $timeLeft;

        $this->score = $this->question->isCorrect($this->response) * ($timeLeft * 1000 / 30);
        $this->save();

        if ($this->score > 0) {
            $this->player->increment('score', $this->score);
        }

        return $this;
    }
}
