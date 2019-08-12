<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPersonalStrengthToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'personal_strength'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('personal_strength', 255)->nullable();

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
        if (Schema::hasColumn('users', 'personal_strength'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('personal_strength');
                
            });
        }
    }
}
