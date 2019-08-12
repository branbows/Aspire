<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropClassColumnsFromResumetemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('resumetemplates', 'class'))
        {
            Schema::table('resumetemplates', function (Blueprint $table) {

                $table->dropColumn('class');

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
        if (Schema::hasColumn('resumetemplates', 'class'))
        {
            Schema::table('resumetemplates', function (Blueprint $table) {

                $table->dropColumn('class');

            });
        }
    }
}
