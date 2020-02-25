<?php

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
        Route::livewire('/quiz/{quizSession}', 'admin.quiz')->name('admin.quiz.start');
        Route::livewire('/quiz/{quizSession}/play', 'admin.play-quiz')->name('admin.quiz.play');
    });
