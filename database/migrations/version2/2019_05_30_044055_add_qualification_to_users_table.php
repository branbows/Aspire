<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQualificationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'qualification')) {

            Schema::table('users', function(Blueprint $table) {

                $table->string('qualification', 255)->nullable();
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
        if (Schema::hasColumn('users', 'qualification')) {

            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('qualification');
                
            });
        }   
    }
}
