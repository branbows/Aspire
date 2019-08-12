<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinguisticAbilityToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'linguistic_ability'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('linguistic_ability', 255)->nullable();

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
        if (Schema::hasColumn('users', 'linguistic_ability'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('linguistic_ability');
                
            });
        }
    }
}
