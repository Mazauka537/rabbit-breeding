<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('matings', function (Blueprint $table) {
            $table->dropColumn('control_date');
            $table->dropColumn('successfully');
            $table->string('desc')->nullable()->after('alive_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('matings', function (Blueprint $table) {
            $table->date('control_date')->nullable();
            $table->boolean('successfully')->nullable();
            $table->dropColumn('desc');
        });
    }
}
