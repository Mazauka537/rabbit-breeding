<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMaxlenthOfDescColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('breeds', function (Blueprint $table) {
            $table->string('desc', 1024)->change();
        });
        Schema::table('cages', function (Blueprint $table) {
            $table->string('desc', 1024)->change();
        });
        Schema::table('cage_groups', function (Blueprint $table) {
            $table->string('desc', 1024)->change();
        });
        Schema::table('rabbits', function (Blueprint $table) {
            $table->string('desc', 1024)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('breeds', function (Blueprint $table) {
            $table->string('desc', 256)->change();
        });
        Schema::table('cages', function (Blueprint $table) {
            $table->string('desc', 256)->change();
        });
        Schema::table('cage_groups', function (Blueprint $table) {
            $table->string('desc', 256)->change();
        });
        Schema::table('rabbits', function (Blueprint $table) {
            $table->string('desc', 256)->change();
        });
    }
}
