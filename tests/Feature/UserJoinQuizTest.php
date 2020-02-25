<?php

namespace Tests\Feature;

use App\Http\Livewire\EnterQuiz;
use App\Quiz;
use App\QuizPlayer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class EnterQuizTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_join_the_quiz_by_entering_pin_and_nickname()
    {
        $quiz = factory(Quiz::class)->create();

        $session = $quiz->startSession($pin = '123456');

        Livewire::test(EnterQuiz::class)
            ->set('pin', $pin)
            ->call('enter')
            ->assertSee($quiz->title)
            ->assertSee('Ready!')
            ->set('nickname', 'john')
            ->call('ready')
            ->assertRedirect(route('play', $session));

        $this->assertEquals(1, QuizPlayer::count());
        $this->assertEquals('john', QuizPlayer::first()->nickname);


        Livewire::test(EnterQuiz::class)
            ->assertRedirect(route('play', $session));

        $this->assertEquals(1, QuizPlayer::count());
    }
}
