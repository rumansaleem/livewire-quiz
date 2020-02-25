<?php

namespace App\Http\Livewire;

use App\QuizSession;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;

class PlayQuiz extends Component
{
    public $countdown = 10;
    public $isReady = false;
    public $secsLeft = 10;
    public $quizSession;
    public $question;

    public function render()
    {
        return view('livewire.play-quiz');
    }

    public function isReady()
    {
        $this->isReady = $this->quizSession->isReady();

        if ($this->isReady) {
            $this->countdown();
        }
    }

    public function countdown()
    {
        $this->secsLeft = now()->diffInSeconds($this->quizSession->ready_at, false) + $this->countdown;

        if ($this->secsLeft <= 0) {
            $this->secsLeft = 0;
            $this->loadQuestion();
        }
    }

    public function loadQuestion()
    {
        if (! $this->question) {
            $this->question = $this->quizSession->quiz->questions()->first();
        }
    }

    public function mount(QuizSession $quizSession)
    {
        $this->quizSession = $quizSession->load(['players', 'quiz']);
        $this->isReady();
    }
}
