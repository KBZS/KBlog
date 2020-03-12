<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {

            $table->bigIncrements('id');                // ID of the post
            $table->string('heading', 150);             // Heading (name) of the post
            $table->text('content', 60000);             // Content of the post
            $table->string('sub');                  // Auth0 user sub id value (user id of the author)
            $table->string('image')->nullable();    // Image of the post
            $table->boolean('nsfw');                // NSFW (not safe for work) mark
            $table->timestamps();
            
            // Foreign key
            $table->foreign('sub')->references('sub')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
