<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedSmallInteger('days_for_delete_reminders')->default(0)->after('auto_mating_reminders');
            $table->boolean('delete_only_checked_reminders')->default(true)->after('auto_mating_reminders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('days_for_delete_reminders');
            $table->dropColumn('delete_only_checked_reminders');
        });
    }
}
