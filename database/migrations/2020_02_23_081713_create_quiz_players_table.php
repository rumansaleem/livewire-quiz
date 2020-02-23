<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuizPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_players', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quiz_session_id')->index();
            $table->string('nickname', 100);
            $table->unsignedInteger('score')->default(0);
            $table->timestamps();

            $table->unique(['quiz_session_id', 'nickname']);
            $table->foreign('quiz_session_id')->references('id')->on('quiz_sessions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_players');
    }
}
