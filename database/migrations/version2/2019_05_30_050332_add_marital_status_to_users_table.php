<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMaritalStatusToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'marital_status'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->enum('marital_status', ['Married', 'Unmarried'])->nullable();

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
        if (Schema::hasColumn('users', 'marital_status'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('marital_status');
                
            });
        }
    }
}
