<?php

namespace App\Http\Livewire;

use App\QuizSession;
use Livewire\Component;

class Quiz extends Component
{
    public $session;

    public function render()
    {
        return view('livewire.quiz');
    }

    public function redirectIfReady()
    {
        if($this->session->isReady()) {
            return redirect()->route('quiz.play', $this->session);
        }
    }

    public function loadPlayers()
    {
        $this->session->load('players');
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession->load(['players', 'quiz']);
        $this->redirectIfReady();
    }
}
