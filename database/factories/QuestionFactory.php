<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Question;
use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'text' => $faker->realText,
        'quiz_id' => function() {
            return factory(Quiz::class)->create();
        },
        'options' => array_combine(['a', 'b', 'c', 'd'], $faker->words(4)),
        'correct_key' => $faker->randomElement(['a', 'b', 'c', 'd']),
    ];
});
