<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

Route::layout('layouts.master')->section('body')->group(function () {
    Route::livewire('/', 'enter-quiz')->name('enter');
    Route::livewire('/play/{quizSession}', 'play-quiz')->name('play');
});
