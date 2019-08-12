<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFatherNameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'father_name'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('father_name', 255)->nullable();

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
        if (Schema::hasColumn('users', 'father_name'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('father_name');
                
            });
        }
    }
}
