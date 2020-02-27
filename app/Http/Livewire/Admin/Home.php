<?php

namespace App\Http\Livewire\Admin;

use App\Quiz;
use App\QuizSession;
use Livewire\Component;

class Home extends Component
{
    public $quizzes = [];

    public function render()
    {
        return view('livewire.admin.home');
    }

    public function startSession($quizId)
    {
        $quiz = $this->quizzes[$quizId];

        $session = $quiz->startSession(rand(pow(10, 5), pow(10, 6) - 1));

        return redirect()->route('admin.quiz.start', $session);
    }

    public function abandonAndStartNewSession($quizId, $sessionId)
    {
        QuizSession::where('id', $sessionId)->where('quiz_id', $quizId)->delete();

        $quiz = $this->quizzes[$quizId];

        $session = $quiz->startSession(rand(pow(10, 5), pow(10, 6) - 1));

        return redirect()->route('admin.quiz.start', $session);
    }

    public function discardSession($sessionId)
    {
        QuizSession::where('id', $sessionId)->delete();

        return redirect()->route('admin.home');
    }

    public function mount()
    {
        $this->quizzes = Quiz::withFreshSession()->get()->keyBy('id');
    }
}
