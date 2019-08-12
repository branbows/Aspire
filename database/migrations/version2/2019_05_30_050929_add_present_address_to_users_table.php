<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPresentAddressToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'present_address'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('present_address', 255)->nullable();

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
        if (Schema::hasColumn('users', 'present_address'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('present_address');
                
            });
        }
    }
}
