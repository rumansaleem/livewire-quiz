<?php

namespace Tests\Unit;

use App\Question;
use App\Quiz;
use App\QuizPlayer;
use App\QuizSession;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizSessionTest extends TestCase
{
    use RefreshDatabase;

    public function test_session_has_many_players()
    {
        $session = factory(QuizSession::class)->create();
        $quizSessionPlayers = factory(QuizPlayer::class, 3)->create(['quiz_session_id' => $session->id]);

        $this->assertInstanceOf(HasMany::class, $session->players());
        $this->assertCount(3, $session->players);
        $this->assertInstanceOf(QuizPlayer::class, $session->players->first());
    }

    public function test_it_belongs_to_a_quiz()
    {
        $quiz = factory(Quiz::class)->create();
        $session = factory(QuizSession::class)->create(['quiz_id' => $quiz->id]);

        $this->assertInstanceOf(BelongsTo::class, $session->quiz());
        $this->assertInstanceOf(Quiz::class, $session->quiz);
        $this->assertEquals($quiz->title, $session->quiz->title);
    }

    public function test_join_as_method()
    {
        $session = factory(QuizSession::class)->create();

        $player = $session->joinAs('john');

        $this->assertCount(1, $session->fresh()->players);
        $this->assertTrue($player->is($session->fresh()->players->first()));
    }

    public function test_start_method_adds_started_at_clears_pin_initialise_first_question()
    {
        $session = factory(QuizSession::class)->create();
        factory(Question::class)->create(['quiz_id' => $session->quiz_id]);

        $session->start();

        $this->assertEqualsWithDelta(now(), $session->started_at, 1);
        $this->assertNull($session->pin);
        $this->assertEquals(0, $session->current_question_index);
    }

    public function test_is_active_method()
    {
        $session = factory(QuizSession::class)->create();

        $this->assertFalse($session->isActive());
        factory(Question::class)->create(['quiz_id' => $session->quiz_id ]);

        $session->start();

        $this->assertTrue($session->isActive());
    }
}
