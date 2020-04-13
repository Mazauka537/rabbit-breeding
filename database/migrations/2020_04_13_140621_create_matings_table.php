<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('male_id');
            $table->unsignedBigInteger('female_id');
            $table->date('date');
            $table->date('control_date')->nullable();
            $table->boolean('successfully')->nullable();
            $table->date('date_birth')->nullable();
            $table->unsignedInteger('child_count')->nullable();
            $table->unsignedInteger('alive_count')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('female_id')->references('id')->on('rabbits');
            $table->foreign('male_id')->references('id')->on('rabbits');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matings');
    }
}
