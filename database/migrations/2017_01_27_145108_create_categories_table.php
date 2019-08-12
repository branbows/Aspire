<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('meta_tag_title');
            $table->string('meta_tag_description');
            $table->string('meta_tag_keywords');
            $table->string('image');
            $table->integer('parent_id');
            $table->text('seo_keywords');
            $table->tinyInteger('show_in_menu');
            $table->integer('columns');
            $table->integer('sort_order');
            $table->tinyInteger('status');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
