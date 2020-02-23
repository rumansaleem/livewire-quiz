<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\QuizPlayer;
use App\QuizSession;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(QuizPlayer::class, function (Faker $faker) {
    return [
        'quiz_session_id' => function() {
            return factory(QuizSession::class)->create()->id;
        },
        'nickname' => Str::slug($faker->unique()->name),
    ];
});
