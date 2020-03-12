<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstSecondTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('first_second', function (Blueprint $table) {
            $table->primary(['first_id', 'second_id']);
            $table->unsignedBigInteger('first_id');
            $table->unsignedBigInteger('second_id');
            $table->timestamps();

            // Foreign keys 
            $table->foreign('first_id')->references('id')->
                on('firsts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('second_id')->references('id')->
                on('seconds')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('first_second');
    }
}
