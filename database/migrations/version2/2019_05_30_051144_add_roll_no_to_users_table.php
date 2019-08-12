<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRollNoToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'roll_no'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('roll_no', 255)->nullable();

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
        if (Schema::hasColumn('users', 'roll_no'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('roll_no');
                
            });
        }
    }
}
