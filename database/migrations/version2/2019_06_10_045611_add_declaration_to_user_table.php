<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeclarationToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'declaration'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->string('declaration', 1000)->nullable();

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
        if (Schema::hasColumn('users', 'declaration'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('declaration');
                
            });
        }
    }
}
