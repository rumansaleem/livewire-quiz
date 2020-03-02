<?php

namespace App\Http\Livewire\Admin;

use App\Events\QuestionCompleted;
use App\QuizSession;
use Livewire\Component;

class PlayQuiz extends Component
{
    public $session;
    public $question;
    public $showAnswers = false;
    public $optionPolls = [];
    public $responses = [];

    public function getListeners()
    {
        return [
            "echo:private-Admin.Quiz.{$this->session['id']},AnswerReceived" => 'addAnswer'
        ];
    }

    public function render()
    {
        return view('livewire.admin.play-quiz');
    }

    public function addAnswer($response) {
        array_push($this->responses, $response);

        if ($this->showAnswers = $this->receivedAllResponses()) {
            $this->showAnswers();
        }
    }

    public function showAnswers()
    {
        $this->responses = $this->session->responses()
            ->whereQuestionId($this->question->id)
            ->get();

        $this->responses->map->evaluate();

        event(new QuestionCompleted($this->session, $this->question));

        $this->optionPolls = collect($this->question->options)
            ->map(function ($text, $key) {
                return collect($this->responses)
                    ->where('response', $key)->count();
            })->toArray();
    }

    public function receivedAllResponses()
    {
        return $this->session->players->count() === count($this->responses);
    }

    public function loadResponsesCount()
    {
        $this->question->load('responses');
    }

    public function mount(QuizSession $quizSession)
    {
        $this->session = $quizSession->load(['quiz.questions', 'players']);

        if ($quizSession->current_question_index === null || $quizSession->ended_at) {
            $this->question = $quizSession->quiz->questions->last();
            return redirect(route('admin.quiz.leaderboard', $quizSession));
        }

        $this->question = $quizSession->quiz->questions->get($quizSession->current_question_index, null);

        $this->responses = $quizSession->responses()
            ->where('question_id', $this->question)
            ->get()->toArray();

        if ($this->showAnswers = $this->receivedAllResponses()) {
            $this->showAnswers();
        }
    }
}
