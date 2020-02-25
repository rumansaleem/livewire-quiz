<?php

namespace App\Http\Livewire;

use App\QuizSession;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Home extends Component
{
    public $pin = '';
    public $nickname = '';
    public $enteredSession = null;

    public function render()
    {
        return view('livewire.home');
    }

    public function enter()
    {
        $this->validate([
            'pin' => ['required', 'numeric', 'digits:6', 'exists:quiz_sessions,pin']
        ]);

        $this->enteredSession = QuizSession::with('quiz')->where('pin', $this->pin)->first();
        session()->put('active_quiz_session', $this->enteredSession->id);
    }

    public function ready()
    {
        $this->validate([
            'nickname' => [
                'required', 'string', 'max:100',
                Rule::unique('quiz_players', 'nickname')
                    ->where('quiz_session_id', $this->enteredSession->id)
            ]
        ]);

        $this->enteredSession->joinAs($this->nickname);

        return redirect()->route('quiz.enter', $this->enteredSession);
    }

    public function mount()
    {
        $this->enteredSession = QuizSession::with('quiz')
            ->where('id', session()->get('active_quiz_session', null))
            ->first();

        if ($this->enteredSession && $nickname = session("quiz_session.{$this->enteredSession->id}.nickname")) {
            $this->enteredSession->joinAs($nickname);

            return redirect()->route('quiz.enter', $this->enteredSession);
        }
    }
}
