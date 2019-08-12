<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTourapplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tourapplications', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->date('start_date');
            $table->string('travel_mode');
            $table->decimal('ticket_cost',10,2);
            $table->decimal('cab_cost_home',10,2);
            $table->decimal('cab_cost_destination',10,2);
            $table->decimal('hotel_cost',10,2);
            $table->integer('manager_id')->default(NULL);
            $table->enum('status',['draft','submitted','approved','rejected','request_for_information'])->default('draft');
            
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
        Schema::dropIfExists('tourapplications');
    }
}
