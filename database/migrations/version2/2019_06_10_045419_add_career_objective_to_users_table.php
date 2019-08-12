<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCareerObjectiveToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'career_objective'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('career_objective', 1000)->nullable();

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
        if (Schema::hasColumn('users', 'career_objective'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('career_objective');
                
            });
        }
    }
}
