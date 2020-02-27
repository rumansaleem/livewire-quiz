<?php

namespace App\Http\Livewire\Admin;

use App\QuizSession;
use Livewire\Component;

class PlayQuiz extends Component
{
    public $session;
    public $question;
    public $showAnswers = false;
    public $optionPolls = [];

    public function render()
    {
        return view('livewire.admin.play-quiz');
    }

    public function pollShowAnswers()
    {
        $this->showAnswers = $this->receivedAllResponses();

        if ($this->showAnswers) {
            $this->optionPolls = collect($this->question->options)
                ->map(function ($text, $key) {
                    return $this->question->responses
                        ->where('response', $key)->count();
                })->toArray();
        }
    }

    protected function receivedAllResponses()
    {
        return $this->session->players->count() === $this->question->responses->count();
    }

    public function loadResponsesCount()
    {
        $this->question->load('responses');
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession->load(['quiz.questions', 'players']);
        $this->question = $quizSession->quiz->questions->get($quizSession->current_question_index, null);
        $this->question->load('responses');
    }
}
