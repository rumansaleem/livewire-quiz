<?php

namespace App\Http\Livewire;

use App\Events\PlayerJoined;
use App\PlayerSession;
use App\QuizSession;
use Illuminate\Support\Facades\Gate;
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

        PlayerSession::id($this->enteredSession->id);
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

        $player = $this->enteredSession->joinAs($this->nickname);

        event(new PlayerJoined($player, $this->enteredSession));

        return redirect()->route('quiz.enter', $this->enteredSession);
    }

    public function mount()
    {
        if (PlayerSession::id()) {
            $this->enteredSession = QuizSession::with('quiz')
                ->where('id', PlayerSession::id())
                ->first();
        }

        if ($this->enteredSession && $nickname = PlayerSession::nickname()) {
            $this->nickname = $nickname;
            $this->enteredSession->joinAs($nickname);

            dd(Gate::allows('view', $this->enteredSession));
            return redirect()->route('quiz.enter', $this->enteredSession);
        }
    }
}
