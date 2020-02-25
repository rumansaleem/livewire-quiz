<?php

use App\Question;
use App\Quiz;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $quiz = factory(Quiz::class)->create();
        factory(Question::class, 10)->create(['quiz_id' => $quiz->id]);
    }
}
