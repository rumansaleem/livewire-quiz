<?php

namespace App\Http\Livewire\Admin;

use App\QuizSession;
use Livewire\Component;

class Quiz extends Component
{
    public $session;

    protected function getListeners() {
        return [
            "echo:private-Admin.Quiz.{$this->session['id']},PlayerJoined" => 'loadPlayers'
        ];
    }

    public function render()
    {
        return view('livewire.admin.quiz');
    }

    public function loadPlayers()
    {
        $this->session->load('players');
    }

    public function start()
    {
        $this->session->start();

        return redirect()->route('admin.quiz.play', $this->session);
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession;

        if ($this->session->isActive()) {
            return redirect()->route('admin.quiz.play', $this->session);
        }
    }
}
