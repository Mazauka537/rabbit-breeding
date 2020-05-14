<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeOndeleteCascadeToForeigns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vaccinations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rabbit_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rabbit_id')->references('id')->on('rabbits')->onDelete('cascade');
        });
        Schema::table('reminders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rabbit_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rabbit_id')->references('id')->on('rabbits')->onDelete('cascade');
        });
        Schema::table('breeds', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('cages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('cage_groups', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('matings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('default_notifies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vaccinations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rabbit_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rabbit_id')->references('id')->on('rabbits');
        });
        Schema::table('reminders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rabbit_id']);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rabbit_id')->references('id')->on('rabbits');
        });
        Schema::table('breeds', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('cages', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('cage_groups', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('matings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('default_notifies', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
}
