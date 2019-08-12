<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectTaughtToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'subject_taught'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->text('subject_taught')->nullable();

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
        if (Schema::hasColumn('users', 'subject_taught'))
        {
            Schema::table('users', function (Blueprint $table) {

                $table->dropColumn('subject_taught');
                
            });
        }
    }
}
