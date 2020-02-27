<?php

namespace App\Http\Livewire;

use App\QuizSession;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Quiz extends Component
{
    use AuthorizesRequests;

    public $session;

    public function render()
    {
        return view('livewire.quiz');
    }

    public function redirectIfActive()
    {
        if ($this->session->isActive()) {
            return redirect()->route('quiz.play', $this->session);
        }
    }

    public function mount(QuizSession $quizSession)
    {
        $this->authorize('view', $quizSession);

        $this->session = $quizSession->load(['quiz']);
        $this->redirectIfActive();
    }
}
