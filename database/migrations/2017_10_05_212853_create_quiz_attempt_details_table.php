<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizAttemptDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempt_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attempt_id')->unsigned();
            $table->text('question');
            $table->text('chosen_answer');
            $table->text('correct_answer');
            
            $table->timestamps();
            
            $table->foreign('attempt_id')->references('id')->on('quiz_attempts')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_attempt_details');
    }
}
