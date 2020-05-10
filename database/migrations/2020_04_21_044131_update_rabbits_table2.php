<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRabbitsTable2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rabbits', function (Blueprint $table) {
            $table->dropColumn('mother_id');
            $table->dropColumn('father_id');
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
            $table->unsignedBigInteger('father_id')->nullable()->after('desc');
            $table->unsignedBigInteger('mother_id')->nullable()->after('desc');
        });
    }
}
