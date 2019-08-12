<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Faqs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('faqs')) {
            Schema::create('faqs', function(Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('category_id')->length(10)->unsigned();
                $table->string('question', 512);
                $table->mediumText('slug');
                $table->mediumText('answer');
                $table->tinyInteger('status')->default('0');
                $table->timestamps();
            });

            Schema::table('faqs', function($table) {
                 $table->foreign('category_id')->references('id')->on('faqcategories')->onDelete('cascade');
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
        Schema::dropIfExists('faqs');
    }
}
