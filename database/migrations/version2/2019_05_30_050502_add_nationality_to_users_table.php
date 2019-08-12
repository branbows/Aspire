<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNationalityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'nationality'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('nationality', 255)->nullable();

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
        if (Schema::hasColumn('users', 'nationality'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('nationality');
                
            });
        }
    }
}
