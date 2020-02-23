<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\QuizSession;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class QuizPlayerController extends Controller
{
    public function joinByPin(Request $request)
    {
        $request->validate([
            'pin' => 'required|numeric|digits:6|exists:quiz_sessions,pin',
            'nickname' => ['required'],
        ]);

        $quizSession = QuizSession::where('pin', $request->pin)->first();

        $quizSession->joinAs($request->nickname);

        return redirect()->route('quiz_sessions.play', $quizSession);
    }
}
