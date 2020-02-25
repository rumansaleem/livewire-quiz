<?php

namespace Tests\Unit;

use App\Question;
use App\Quiz;
use App\QuizSession;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class QuizTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_may_have_many_sessions()
    {
        $quiz = factory(Quiz::class)->create();
        factory(QuizSession::class, 3)->create(['quiz_id' => $quiz->id]);

        $this->assertInstanceOf(HasMany::class, $quiz->sessions());
        $this->assertCount(3, $quiz->sessions);
        $this->assertInstanceOf(QuizSession::class, $quiz->sessions->first());
    }

    public function test_it_has_many_questions()
    {
        $quiz = factory(Quiz::class)->create();
        factory(Question::class, 3)->create(['quiz_id' => $quiz->id]);

        $this->assertInstanceOf(HasMany::class, $quiz->questions());
        $this->assertCount(3, $quiz->questions);
        $this->assertInstanceOf(Question::class, $quiz->questions->first());
    }

    public function test_start_method()
    {
        $quiz = factory(Quiz::class)->create();

        $quizSession = $quiz->startSession($pin = 12345);

        $this->assertNotNull($quizSession);
        $this->assertEquals($pin, $quizSession->pin);
    }
}
