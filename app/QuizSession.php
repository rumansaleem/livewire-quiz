<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    protected $fillable = ['pin'];

    public function joinAs($nickname)
    {
        return $this->players()->create(['nickname' => $nickname]);
    }

    public function players()
    {
        return $this->hasMany(QuizPlayer::class);
    }
}
