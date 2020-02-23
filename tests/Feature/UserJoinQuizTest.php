<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserJoinQuizTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_join_the_quiz_by_entering_pin_and_nickname()
    {
        $quiz = factory('App\Quiz')->create();

        $session = $quiz->startSession($pin = '123456');

        $this->withoutExceptionHandling()
        ->post(route('join_quiz'), [
            'pin' => $pin,
            'nickname' => $nickname = 'john',
        ])->assertRedirect(route('quiz_sessions.play', $session));

        $this->assertCount(1, $session->players);
        $this->assertEquals($nickname, $session->players->first()->nickname);

    }
}
