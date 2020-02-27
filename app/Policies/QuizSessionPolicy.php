<?php

namespace App\Policies;

use App\PlayerSession;
use App\QuizPlayer;
use App\QuizSession;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuizSessionPolicy
{
    use HandlesAuthorization;

    public function view($user = null, QuizSession $quizSession)
    {
        // dd($quizSession->id === PlayerSession::id(), $quizSession->players->pluck('nickname')->contains(PlayerSession::nickname()));

        return (int) $quizSession->id === (int) PlayerSession::id()
            && $quizSession->players->pluck('nickname')
                ->contains(PlayerSession::nickname());
    }

    public function play($user = null, QuizSession $quizSession)
    {
        return $this->view($user, $quizSession)
            && $quizSession->isActive();
    }
}
