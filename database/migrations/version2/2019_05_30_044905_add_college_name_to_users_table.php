<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollegeNameToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'college_name'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('college_name', 255)->nullable();

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
        if (Schema::hasColumn('users', 'college_name'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('college_name');
                
            });
        }
    }
}
