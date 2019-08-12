<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollegePlaceToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'college_place'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('college_place', 255)->nullable();

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
        if (Schema::hasColumn('users', 'college_place'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('college_place');
                
            });
        }
    }
}
