<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOndeleteSetnullToForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropForeign(['breed_id']);
            $table->dropForeign(['cage_id']);
            $table->foreign('breed_id')->references('id')->on('breeds')->onDelete('set null');
            $table->foreign('cage_id')->references('id')->on('cages')->onDelete('set null');
        });
        Schema::table('matings', function (Blueprint $table) {
            $table->dropForeign(['male_id']);
            $table->dropForeign(['female_id']);
            $table->foreign('male_id')->references('id')->on('rabbits')->onDelete('set null');
            $table->foreign('female_id')->references('id')->on('rabbits')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropForeign(['breed_id']);
            $table->dropForeign(['cage_id']);
            $table->foreign('breed_id')->references('id')->on('breeds');
            $table->foreign('cage_id')->references('id')->on('cages');
        });
        Schema::table('matings', function (Blueprint $table) {
            $table->dropForeign(['male_id']);
            $table->dropForeign(['female_id']);
            $table->foreign('male_id')->references('id')->on('rabbits');
            $table->foreign('female_id')->references('id')->on('rabbits');
        });
    }
}
