<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCagesTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cages', function (Blueprint $table) {
            $table->foreign('cage_group_id')
                ->references('id')
                ->on('cage_groups')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cages', function (Blueprint $table) {
            $table->dropForeign(['cage_group_id']);
        });
    }
}
