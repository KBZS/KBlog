<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');            // Local id of the user
            $table->string('name');                 // Username of the user
            $table->string('sub')->unique();        // Unique Auth0 user_id value which is used to locate users on server side.
            $table->string('picture')->nullable();  // Avatar (profile picture) of the user
            $table->integer('posts')->default(0);   // Number of posts user have createds
            $table->string('email')->nullable();    // Users email address
            $table->rememberToken();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
