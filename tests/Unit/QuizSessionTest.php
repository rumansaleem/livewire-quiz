<?php

namespace Tests\Unit;

use App\QuizPlayer;
use App\QuizSession;
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

    public function test_join_as_method()
    {
        $session = factory(QuizSession::class)->create();

        $player = $session->joinAs('john');

        $this->assertCount(1, $session->fresh()->players);
        $this->assertTrue($player->is($session->fresh()->players->first()));
    }
}
