<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCountryToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'country'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('country', 255)->nullable();

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
        if (Schema::hasColumn('users', 'country'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('country');
                
            });
        }
    }
}
