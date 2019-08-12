<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldOfInterestToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'field_of_interest'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->text('field_of_interest')->nullable();

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
        if (Schema::hasColumn('users', 'field_of_interest'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('field_of_interest');
                
            });
        }
    }
}
