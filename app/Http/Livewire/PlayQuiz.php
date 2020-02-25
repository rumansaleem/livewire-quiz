<?php

namespace App\Http\Livewire;

use App\QuizSession;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;

class PlayQuiz extends Component
{
    public $session;
    public $question;
    public $player;

    public function render()
    {
        return view('livewire.play-quiz');
    }

    public function loadQuestion()
    {
        $this->question = $this->session->quiz->questions->get($this->session->current_question_index, null);
    }

    public function storeAnswer()
    {

    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession->load(['quiz']);

        $this->player = $quizSession->players()->whereNickname(
            session("quiz_sessions.{$this->session->id}.nickname")
        )->first();

        $this->loadQuestion();
    }
}
