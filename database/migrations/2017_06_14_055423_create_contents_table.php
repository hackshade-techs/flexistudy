<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lesson_id')->unsigned();
            $table->enum('content_type', ['video', 'article'])->default('video');
            $table->string('video_provider')->nullable();
            $table->string('video_filename')->nullable();
            $table->integer('video_duration')->nullable();
            $table->string('video_path')->nullable();
            $table->enum('video_storage', ['s3', 'local'])->nullable();
            $table->enum('video_src', ['upload', 'embed'])->nullable();
            $table->text('article_body')->nullable();
            $table->timestamps();
            
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
