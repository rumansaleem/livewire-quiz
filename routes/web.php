<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::layout('layouts.master')->section('body')->group(function () {
    Route::livewire('/', 'enter-quiz')->name('enter');
    Route::livewire('/play/{quizSession}', 'play-quiz')->name('play');
});

Route::layout('layouts.master')->section('body')->prefix('admin')->middleware('auth.basic')->group(function () {
    Route::livewire('/', 'admin-dashboard')->name('enter');
});
