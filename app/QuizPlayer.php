<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizPlayer extends Model
{
    protected $fillable = ['nickname'];

    public function responses()
    {
        return $this->hasMany(QuestionResponse::class, 'player_id');
    }

    public function respond($question, $key)
    {
        return $this->responses()->firstOrCreate(
            ['question_id' => $question->id],
            ['response' => $key]
        );
    }
}
