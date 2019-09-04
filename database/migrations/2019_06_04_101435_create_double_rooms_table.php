<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoubleRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('double_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('room_number')->nullable();
            $table->longText('obs')->nullable();
            $table->integer('hotel_to_event_id')->unsigned();
            $table->integer('record_id')->unsigned()->nullable();
            $table->integer('companion_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('hotel_to_event_id')->references('id')->on('hotel_to_events');
            $table->foreign('record_id')->references('id')->on('records');
            $table->foreign('companion_id')->references('id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('double_rooms');
    }
}
