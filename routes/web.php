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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/join-quiz', 'QuizPlayerController@joinByPin')->name('join_quiz');
Route::post('/quiz_sessions/{quiz}', 'QuizController@play')->name('quiz_sessions.play');
