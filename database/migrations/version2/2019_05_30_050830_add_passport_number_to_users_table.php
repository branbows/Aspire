<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPassportNumberToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'passport_number'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('passport_number', 255)->nullable();

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
        if (Schema::hasColumn('users', 'passport_number'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('passport_number');
                
            });
        }
    }
}
