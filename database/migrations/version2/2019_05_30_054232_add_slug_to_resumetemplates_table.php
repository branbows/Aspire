<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToResumetemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('resumetemplates', 'slug'))
        {
            Schema::table('resumetemplates', function (Blueprint $table) {

                $table->string('slug', 50);

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
        if (Schema::hasColumn('resumetemplates', 'slug'))
        {
            Schema::table('resumetemplates', function (Blueprint $table) {

                $table->dropColumn('slug');
                
            });
        }
    }
}
