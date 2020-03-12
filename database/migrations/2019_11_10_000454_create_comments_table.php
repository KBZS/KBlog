<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {

            $table->bigIncrements('id');            // Comment ID
            $table->text('content');                // Content of the comment
            $table->string('sub');                  // Auth0 user sub id value (user id of the author)
            $table->unsignedBigInteger('post_id');  // ID of the post where this comment was left
            $table->timestamps();
            
            // Foreign keys 
            $table->foreign('sub')->references('sub')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('post_id')->references('id')->
                on('posts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
