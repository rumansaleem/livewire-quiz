<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quiz;
use App\QuizSession;
use Faker\Generator as Faker;

$factory->define(QuizSession::class, function (Faker $faker) {
    return [
        'quiz_id' => function() {
            return factory(Quiz::class)->create()->id;
        },
    ];
});
