<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_category_id')->unsigned();
            $table->string('lang')->default('en');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->boolean('published')->default(false);
            $table->enum('type', ['page', 'article'])->default('article');
            $table->boolean('display_main_menu')->default(true);
            $table->boolean('display_footer')->default(false);
            $table->boolean('featured_frontend')->default(false);
            $table->timestamps();
            
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
