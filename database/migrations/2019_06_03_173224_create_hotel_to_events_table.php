<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotel_to_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('hotel_id')->unsigned();
            $table->integer('single_rooms')->unsigned()->nullable();
            $table->integer('double_rooms')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_to_events');
    }
}
