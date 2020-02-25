<?php

namespace App\Http\Livewire\Admin;

use App\QuizSession;
use Livewire\Component;

class Quiz extends Component
{
    public $session;

    public function render()
    {
        return view('livewire.admin.quiz');
    }

    public function loadPlayers()
    {
        $this->session->load('players');
    }

    public function ready()
    {
        $this->session->ready();

        return redirect()->route('admin.quiz.play', $this->session);
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession;

        if ($this->session->isReady()) {
            return redirect()->route('admin.quiz.play', $this->session);
        }
    }
}
