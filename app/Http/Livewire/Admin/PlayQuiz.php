<?php

namespace App\Http\Livewire\Admin;

use App\QuizSession;
use Livewire\Component;

class PlayQuiz extends Component
{
    public $session;
    public $question;

    public function render()
    {
        return view('livewire.admin.play-quiz');
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession->load(['quiz.questions', 'players']);
        $this->question = $quizSession->quiz->questions->get($quizSession->current_question_index, null);
    }
}
