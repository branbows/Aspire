<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Resumetemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('resumetemplates')) {
            Schema::create('resumetemplates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 100);
                $table->string('resume_key', 100);
                $table->string('class', 50);
                $table->enum('status', ['0', '1'])->nullable();
                $table->enum('is_default', ['0', '1'])->nullable();
                $table->string('image', 50);
                $table->timestamps();
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
        Schema::dropIfExists('resumetemplates');
    }
}
