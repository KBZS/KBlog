<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdditionalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sub');
            $table->boolean('is_verified');
            $table->boolean('is_admin');
            $table->boolean('is_moderator');
            $table->string('phone_num');
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
        Schema::dropIfExists('additional_infos');
    }
}
