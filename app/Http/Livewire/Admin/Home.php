<?php

namespace App\Http\Livewire\Admin;

use App\Quiz;
use Livewire\Component;

class Home extends Component
{
    public $activeSession = null;

    public function render()
    {
        return view('livewire.admin.home', [
            'quizzes' => Quiz::all()
        ]);
    }

    public function startSession($quizId)
    {
        $quiz = Quiz::find($quizId);

        $session = $quiz->startSession(rand(pow(10, 5), pow(10, 6) - 1));

        return redirect()->route('admin.quiz.start', $session);
    }
}
