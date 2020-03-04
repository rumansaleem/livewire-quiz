<?php

use App\PlayerSession;
use App\QuizSession;
use Illuminate\Support\Facades\Route;

Route::layout('layouts.master')->section('body')->group(function () {
    Route::livewire('/', 'home')->name('home');
    Route::livewire('/quiz/{quizSession}', 'quiz')->name('quiz.enter');
    Route::livewire('/quiz/{quizSession}/play', 'play-quiz')->name('quiz.play');
});

Route::layout('layouts.master')
    ->section('body')
    ->prefix('admin')
    ->middleware('auth.basic')
    ->group(function () {
        Route::livewire('/', 'admin.home')->name('admin.home');
        Route::livewire('/manage/quizzes/{quiz}', 'admin.manage-quiz')->name('admin.quizzes.manage');
        Route::livewire('/quiz/{quizSession}', 'admin.quiz')->name('admin.quiz.start');
        Route::livewire('/quiz/{quizSession}/play', 'admin.play-quiz')->name('admin.quiz.play');
        Route::livewire('/quiz/{quizSession}/leaderboard', 'admin.quiz-leaderboard')->name('admin.quiz.leaderboard');

        Route::post('/quiz/{quizSession}/next', function (QuizSession $quizSession) {
            $question = $quizSession->nextQuestion($delayInSeconds = 1);

            if ($question === null) {
                return redirect()->route('admin.quiz.leaderboard', $quizSession);
            }

            return redirect()->route('admin.quiz.play', $quizSession);
        })->name('admin.quiz.next');
    });
