<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsSupporterToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'is_supporter')) {
            Schema::table('users', function (Blueprint $table) {
                $table->boolean('is_supporter')->default(0);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'is_supporter')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('is_supporter');
            });
        }
    }
}
