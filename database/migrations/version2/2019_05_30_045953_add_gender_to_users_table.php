<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGenderToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'gender'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->enum('gender', ['Male', 'Female'])->nullable();

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
        if (Schema::hasColumn('users', 'gender'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('gender');
                
            });
        }
    }
}
