<?php

namespace App;

use App\Exceptions\UnknownOptionKey;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $casts = [
        'options' => 'array'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(static function($question) {
            if(! in_array($question->correct_key, array_keys($question->options))) {
                throw new UnknownOptionKey('options doesn\'t have the correct key');
            }
        });
    }
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function isCorrect($key)
    {
        return $this->correct_key === $key;
    }
}
